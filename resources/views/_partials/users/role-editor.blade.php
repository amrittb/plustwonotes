<role-editor resource-url="{{ rawurldecode(route('api.v1.users.roles.update',['users' => urlencode('{').'users'.urlencode('}') ])) }}"
             csrf-token="{{ csrf_token() }}">
</role-editor>
