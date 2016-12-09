<?php namespace App\Repositories;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Post;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostQueryBuilder {

    /**
     * Array of available Options.
     *
     * @var array
     */
    protected $availableOptions = [
        'pagination',
        'search',
        'published_before',
        'published_after',
        'updated_before',
        'updated_after',
        'orderby',
        'order',
        'category',
        'grade_id',
        'subject_id',
        'imp',
        'featured',
        'status',
        'include',
    ];

    /**
     * Default Options.
     *
     * @var array
     */
    protected $defaultOptions = [
        'per_page'  => 20,
        'page'      => 1,
        'order'     => 'desc',
        'orderby'   => 'published_at',
        'status'    => Post::STATUS_PUBLISHED,
    ];

    /**
     * Creates Query Builder for options.
     *
     * @param $options
     * @return Builder
     */
    public function createForOptions($options) {
        $query = Post::query();

        $this->addQueryScopes($query, $this->mergeOptions($options));

        return $query;
    }

    /**
     * Adds Query Scopes.
     *
     * @param Builder $query
     * @param $options
     * @throws \Exception
     */
    private function addQueryScopes(Builder $query, $options) {
        foreach($options as $key => $value) {
            if(in_array($key,$this->availableOptions)) {
                $method = $this->getScopeAdderMethodName($key);

                if(method_exists($this,$method)) {
                    $this->{$method}($query, $value);
                } else {
                    throw new \Exception("Method {{$method}} not found in class ".get_class($this));
                }
            }
        }
    }

    /**
     * Returns scope adder method name.
     *
     * @param $key
     * @return string
     */
    private function getScopeAdderMethodName($key) {
        return "addQueryScopeFor" . studly_case($key);
    }

    /**
     * Merges options with default options.
     *
     * @param $options
     * @return array
     */
    private function mergeOptions($options) {
        $allOptions = $this->defaultOptions;

        return $this->parseOptions(array_merge($allOptions, $options));
    }

    /**
     * Parse Options.
     *
     * @param $mergedOptions
     * @return mixed
     */
    private function parseOptions($mergedOptions) {
        $this->parseOrderOption($mergedOptions);
        $this->parseStatusOption($mergedOptions);
        $this->parsePaginationOption($mergedOptions);

        return $mergedOptions;
    }

    /**
     * Parses Order Options.
     *
     * @param $mergedOptions
     */
    private function parseOrderOption(&$mergedOptions) {
        $mergedOptions['order'] = [
            'by' => $mergedOptions['orderby'],
            'direction' => $mergedOptions['order'],
        ];

        unset($mergedOptions['orderby']);

        $order = $mergedOptions['order'];

        // Transforms OrderBy keys to match database.
        switch ($order['by']) {
            case 'title':
                $newTitle = 'post_title';
                break;
            default:
                $newTitle = $order['by'];
                break;
        }

        $order['by'] = $newTitle;

        // Validates Order Direction.
        if( ! in_array($order['direction'], ['asc','desc'])) {
            $order['direction'] = 'desc';
        }
    }

    /**
     * Parses status option.
     *
     * @param $mergedOptions
     */
    private function parseStatusOption(&$mergedOptions) {
        $validStatuses = [
            Post::STATUS_PUBLISHED,
            Post::STATUS_CONTENT_READY,
            Post::STATUS_DRAFT,
            Post::STATUS_TRASHED,
        ];

        if( ! in_array(intval($mergedOptions['status']), $validStatuses)) {
            $mergedOptions['status'] = Post::STATUS_PUBLISHED;
        }
    }

    /**
     * Parses Pagination option.
     *
     * @param $mergedOptions
     */
    private function parsePaginationOption(&$mergedOptions)
    {
        $mergedOptions['pagination'] = [
            'per_page' => $mergedOptions['per_page'],
            'page' => $mergedOptions['page'],
        ];

        unset($mergedOptions['per_page']);
        unset($mergedOptions['page']);
    }

    /**
     * Adds Query Scope for pagination option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForPagination(Builder $query, $value) {
        $page = intval($value['page']);
        $perPage = intval($value['per_page']);

        if($page < 1) {
            $page = 1;
        }

        if($perPage < 1) {
            $perPage = 20;
        }

        $offset = ($page - 1) * $perPage;

        $query->offset($offset)->limit($perPage);
    }

    /**
     * Adds Query Scope for order option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForOrder(Builder $query, $value) {
        $query->orderBy($value['by'], $value['direction']);
    }

    /**
     * Adds Query Scope for search option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForSearch(Builder $query, $value) {
        $query->matchesSearchQuery($value);
    }

    /**
     * Adds query scope for published_before option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForPublishedBefore(Builder $query, $value) {
        $query->publishedBefore(Carbon::parse($value));
    }

    /**
     * Adds query scope for published_after option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForPublishedAfter(Builder $query, $value) {
        $query->publishedAfter(Carbon::parse($value));
    }

    /**
     * Adds query scope for updated_before option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForUpdatedBefore(Builder $query, $value) {
        $query->updatedBefore(Carbon::parse($value));
    }

    /**
     * Adds query scope for updated_after option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForUpdatedAfter(Builder $query, $value) {
        $query->updatedAfter(Carbon::parse($value));
    }

    /**
     * Adds query scope for category option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForCategory(Builder $query, $value) {
        $category = Category::findBySlug($value);

        if($category == null) {
            $category = new Category();
            $category->id = 0;
        }

        $query->ofCategory($category);
    }

    /**
     * Adds query scope for grade_id option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForGradeId(Builder $query, $value) {
        $grade = Grade::find($value);

        if($grade == null) {
            $grade = new Grade();
            $grade->id = 0;
        }

        $query->ofGrade($grade);
    }

    /**
     * Adds query scope for subject_id option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForSubjectId(Builder $query, $value) {
        $subject = Subject::find($value);

        if($subject == null) {
            $subject = new Subject();
            $subject->id = 0;
        }

        $query->ofSubject($subject);
    }

    /**
     * Adds query scope for imp option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForImp(Builder $query, $value) {
        $query->isImportant();
    }

    /**
     * Adds query scope for featured option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForFeatured(Builder $query, $value) {
        $query->isFeatured();
    }

    /**
     * Adds Query Scope for status option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForStatus(Builder $query, $value) {
        $query->ofStatus(intval($value));
    }

    /**
     * Adds query scope for include option.
     *
     * @param Builder $query
     * @param $value
     */
    private function addQueryScopeForInclude(Builder $query, $value) {
        $relations = [];

        $includes = preg_split("/,/",$value);

        if(in_array('grade', $includes)) {
            $relations[] = 'subject.grade';
        } else if(in_array('subject', $includes)) {
            $relations[] = 'subject';
        }

        if(in_array('category', $includes)) {
            $relations[] = 'category';
        }

        if(count($relations)) {
            $query->with($relations);
        }
    }
}