# Plus Two Notes API v1 Doc

This file documents **v1** of Plus Two Notes API.

For common API documentation see [api-doc.md](api-doc.md).

## Endpoints

These end points are prefixed with version number (v1). **http://plustwonotes.com/api/v1/**.

## Authentication

All v1 APIs are authenticated via *JWT Token*. Either pass a **token** request param with *JWT Token* or attach a **Authorization** header with value **Bearer <jwt-token-here>**.

Example:
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6XC9cL3BsdXN0d29ub3Rlcy5hcHBcL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNDgxNzA4Mzk1LCJleHAiOjE0ODE3MTE5OTUsIm5iZiI6MTQ4MTcwODM5NSwianRpIjoiMjAyOTU3MTZiY2E0NjhmNjBhNjJhYTBjYWNmMGJkODQifQ.b5Zs6mXCuBFlu0NUAqGZ3xd_xzwqnct4dOMOyN8Idd8
```

To get _JWT Token_ refer to [api-doc.md](api-doc.md#endpoint-authenticate) in common end points section.

## Resources

In API v1, there are 3 main resources:

* [Post](#resource-post)
* [Category](#resource-category)
* [Grade](#resource-grade)

### <a name="resource-post"></a>Post

Post Resource has two endpoints:

#### /posts - GET
Description: Shows a paginated list of published posts.

Default Response:

```json
{
  "data": [
    {
      "id": 54,
      "title": "Cinemagraphs",
      "slug": "cinemagraphs",
      "created_at": "2016-12-12 17:01:37",
      "updated_at": "2016-12-12 17:03:50",
      "published_at": "2016-12-12 16:51:00",
      "is_imp": false,
      "is_featured": false,
      "links": {
        "self": "http://plustwonotes.app/posts/54",
        "parent": "http://plustwonotes.app/api/v1/posts"
      }
    },
    {
      "id": 53,
      "title": "Cinemagraph",
      "slug": "cinemagraph",
      "created_at": "2016-12-12 06:04:38",
      "updated_at": "2016-12-12 07:08:13",
      "published_at": "2016-12-12 06:03:00",
      "is_imp": false,
      "is_featured": false,
      "links": {
        "self": "http://plustwonotes.app/posts/53",
        "parent": "http://plustwonotes.app/api/v1/posts"
      }
    },
    {
      "id": 52,
      "title": "Hey.",
      "slug": "hey",
      "created_at": "2016-12-08 16:43:09",
      "updated_at": "2016-12-12 07:19:57",
      "published_at": "2016-12-08 16:42:00",
      "is_imp": false,
      "is_featured": false,
      "links": {
        "self": "http://plustwonotes.app/posts/52",
        "parent": "http://plustwonotes.app/api/v1/posts"
      }
    }
  ]
}
```

##### Request Arguments:

* **include** - Includes additional resources or fields. Accepted Values are **'body','category','grade' and 'subject'**. It can have comma separated values for multiple includes. Example: **posts?include=body,category**

> Post Body is not added to response by default. So add ?include=body for including body field.

* **per_page** - **int** - Limits posts per page. **Default Value - 20**.

* **page** - **int** - Page of posts. **Default Value - 1**.

* **order** - **string** - Order the response in either **asc** or **desc**.

* **orderby** - **string** - Order the response by given field. Accepted Values are **title, id, imp, featured, created_at, published_at, updated_at**.

* **search** - **string** - Searches for posts by given query.

* **published_before** - **string** Returns posts published before given date. Accepted values are any parsable date time format Example: 2016-12-14 15:54:00.

* **published_after** - **string** Returns posts published after given date. Accepted values are any parsable date time format Example: 2016-12-14 15:54:00.

* **updated_before** - **string** Returns posts updated before given date. Accepted values are any parsable date time format Example: 2016-12-14 15:54:00.

* **updated_after** - **string** Returns posts updated after given date. Accepted values are any parsable date time format Example: 2016-12-14 15:54:00.

* **category** - **string** Returns posts of the given category. Accepted values are slug of category. Example: **?category=blog**

* **grade_id** - **int** Returns posts of the given grade_id. Accepted values are id of grade.

* **subject_id** - **int** Returns posts of the given subject_id. Accepted values are id of subject.

* **imp** - Returns only important posts. No value is required. Example: **?imp**

* **featured** - Returns only featured posts. No value is required. Example: **?featured**

* **status** - **int** Returns posts of status_id. Accepted values are
    * **1** => **published**
    * **2** => **contentready**
    * **3** => **draft**
    * **4** => **trashed**
    
### /posts/{id} - GET

Description: Returns a post of given id.

Example Response:
```json
{
  "data": {
    "id": 54,
    "title": "Cinemagraphs",
    "slug": "cinemagraphs",
    "created_at": "2016-12-12 17:01:37",
    "updated_at": "2016-12-12 17:03:50",
    "published_at": "2016-12-12 16:51:00",
    "is_imp": false,
    "is_featured": false,
    "links": {
      "self": "http://plustwonotes.app/posts/54",
      "parent": "http://plustwonotes.app/api/v1/posts"
    }
  }
}
```

Post of **{id}** not found response:

```json
{
  "errors": {
    "message": "Post not found for id {55}",
    "code": 404
  }
}
```

#### Request Arguments

* **include** - Includes additional resources or fields. Accepted Values are **'body','category','grade' and 'subject'**. It can have comma separated values for multiple includes. Example: **posts?include=body,category**

> Post Body is not added to response by default. So add ?include=body for including body field.

* **status** - **int** Returns posts of status_id. Accepted values are
    * **1** => **published**
    * **2** => **contentready**
    * **3** => **draft**
    * **4** => **trashed**

### <a name="resource-category"></a>Category

Category resource has only one endpoint:

#### /categories - GET

Example Response:

```json
{
  "data": [
    {
      "id": 1,
      "name": "Note",
      "has_subject": true
    },
    {
      "id": 2,
      "name": "Syllabus",
      "has_subject": true
    },
    {
      "id": 3,
      "name": "Blog",
      "has_subject": false
    }
  ]
}
```

### <a name="resource-grade"></a>Grade

Grade Resource has only one endpoint.

#### /grades - GET

Example Response:

```json
{
  "data": [
    {
      "id": 1,
      "name": "11",
      "subject_ids": [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9
      ]
    },
    {
      "id": 2,
      "name": "12",
      "subject_ids": [
        10,
        11,
        12,
        13,
        14,
        15,
        16,
        17
      ]
    }
  ]
}
```

##### Request Arguments:

* **include** - **string** Includes additional resource in the response. Accepted Values are **subjects**.

**/v1/grades?include=subjects**

```json
{
  "data": [
    {
      "id": 1,
      "name": "11",
      "subject_ids": [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9
      ],
      "subjects": {
        "data": [
          {
            "id": 1,
            "name": "Physics",
            "grade_id": 1
          },
          {
            "id": 2,
            "name": "Chemistry",
            "grade_id": 1
          },
          {
            "id": 3,
            "name": "Biology",
            "grade_id": 1
          },
          {
            "id": 4,
            "name": "Maths",
            "grade_id": 1
          },
          {
            "id": 5,
            "name": "English",
            "grade_id": 1
          },
          {
            "id": 6,
            "name": "Computer",
            "grade_id": 1
          },
          {
            "id": 7,
            "name": "Business Maths",
            "grade_id": 1
          },
          {
            "id": 8,
            "name": "Economics",
            "grade_id": 1
          },
          {
            "id": 9,
            "name": "Accountancy",
            "grade_id": 1
          }
        ]
      }
    }
  ]
}
```