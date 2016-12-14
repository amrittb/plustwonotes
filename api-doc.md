# Plus Two Notes API Docs

API Doc for Plus Two Notes.

All API begins at **http://plustwonotes.com/api/** 

## <a name="common-endpoints"></a>Common Endpoints

These end points does not require and version prefixes.

### <a name="endpoint-ping"></a> /ping - GET
Example Response at **http://plustwonotes.com/api/ping**:
```json
{
  "ping": 1
}
```

### <a name="endpoint-authenticate"></a> /authenticate - POST
Authenticates User and returns JWT Token if user is present.

Send **POST** request to **http://plustwonotes.com/api/authenticate** with body as **x-www-form-urlencoded** of key **identifier** and **secret**.
Send email through **identifier** and password through **secret**.

Correct Credential Reponse:

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6XC9cL3BsdXN0d29ub3Rlcy5hcHBcL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNDgxNzA4Mzk1LCJleHAiOjE0ODE3MTE5OTUsIm5iZiI6MTQ4MTcwODM5NSwianRpIjoiMjAyOTU3MTZiY2E0NjhmNjBhNjJhYTBjYWNmMGJkODQifQ.b5Zs6mXCuBFlu0NUAqGZ3xd_xzwqnct4dOMOyN8Idd8"
}
```

Invalid Credential Response:

```json
{
  "errors": {
    "message": "Invalid Credentials.",
    "code": 401
  }
}
```


