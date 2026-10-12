# Laravel REST Posta EndPoints

## API Endpoints

| Endpoint          | HTTP Method | Authentication | Response                 |
|-------------------|-------------|----------------|--------------------------|
| `/api/users/login`| `POST`      | No             | User and token           |
| `/api/users`      | `GET`       | Yes            | All users                |
| `/api/cities`     | `GET`       | No             | All cities               |
| `/api/cities`     | `POST`      | Yes            | Newly added city         |
| `/api/cities/{id}`| `PATCH`     | Yes            | Updated city             |
| `/api/cities/{id}`| `DELETE`    | Yes            | Deleted city's ID        |
| `/api/counties`   | `GET`       | No             | All counties             |
| `/api/counties`   | `POST`      | Yes            | Newly added county       |
| `/api/counties/{id}`| `PATCH`   | Yes            | Updated county           |
| `/api/counties/{id}`| `DELETE`  | Yes            | Deleted county's ID      |

The authenticated endpoints expect a Sanctum bearer token in the `Authorization`
header. City creation and update require `name` and `county_id`; `zip_code` and
`population` are optional.