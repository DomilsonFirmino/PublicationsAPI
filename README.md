# PublicationsAPI

PublicationsAPI is a API made using laravel and sanctum for user autentication, publications + comments CRUD operations.

## Features

- User Autentication
- CRUD Publications
- CRUD Comments

## Requiriments

- PHP >= 8.2
- Laravel >= 8.0
- Composer
- sqlite

## Instalation

1. Clone the repository

    ```bash
    git clone https://github.com/DomilsonFirmino/PublicationsAPI.git
    cd PublicationsAPI
    ```

2. Instale the dependences

    ```bash
    composer install
    ```

3. Configure the `.env`

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure the conexion to the database in the `.env` file or add the database file

5. Execute the migrations { with seeding if you want}

    ```bash
    php artisan migrate:fresh --seed
    ```

6. Start the development server

    ```bash
    php artisan serve
    ```
7. Opcionaly use postman to test the API

Here's a neatly styled section for your GitHub README:

---

## ENDPOINTS

### Autenticaction

- **Register:** `POST /api/register`

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "username": "Star99",
    "email": "email2@gmail.com",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```

- **Login:** `POST /api/login`

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "email": "email2@gmail.com",
    "password": "12345678",
}
```

- **Logout:** `POST /api/logout`

#### Autorization

```json
{
    "token": "<token>"
}
```

### Users

- **Users:** `GET /api/users`
- - Return all users
- **User** `GET /api/users/{id}`
- - Return a single user 
- **User and comments** `GET /api/users/{id}/comments`
- - Return a single user with all is comments and pagination {?size={value}} to paginate 
- **User and publications** `GET /api/users/{id}/publications`
- - Return a single user with all is publications and pagination {?size={value}} to paginate

### Publication

- **List Publications:** `GET /api/publications`
- - Return all publications, with its user

- **Show Publication:** `GET /api/publications/{id}`
- - Return a single publication, with its user

- **Show Publication and comments:** `GET /api/publications/{id}/comments`
- - Return a single publication, with its users, comments and pagination {?size={value}} to paginate 

- **Create a Publication:** `POST /api/publications`

#### Autorization

```json
{
    "token": "<token>"
}
```

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "title":"first publication",
    "content":"Something is the body of the publication"   
}
```

- **Update Publication:** `PATCH /api/publications/{id}`
#### Autorization

```json
{
    "token": "<token>"
}
```

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "title":"first publication updated",
    "content":"Something is the body of the publication updated"   
}
```

- **Delete Publication:** `DELETE /api/publications/{id}`
#### Autorization

```json
{
    "token": "<token>"
}
```
- - Return messague informing the sucess of the operation

### comments

- **Show Comment:** `GET /api/comments/{id}`
- - Return a single commnet, with all its comments, user and pagination {?size={value}} to paginate 

- **Create comment:** `POST api/comments/`
#### Autorization

```json
{
    "token": "<token>"
}
```

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "comment_id": null,
    "content": "É o meu ?",
    "publication_id": 1
}   

```
- - Comment_id: is to indicate the comment its maded upon
- - Return the comment with its user and other comments

- **update Comment:** `PUT /api/comments/{id}`
#### Autorization

```json
{
    "token": "<token>"
}
```

#### Request Headers

```json
{
    "Accept": "application/json"
}
```

#### Request Body

```json
{
    "content": "Content changed"   
}
```

- **Deletar Comentário:** `DELETE /api/comments/{id}`
#### Autorization

```json
{
    "token": "<token>"
}
```
- - Return messague informing the sucess of the operation

## License

This project is under the [MIT License](LICENSE).

