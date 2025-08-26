# Cafe Menu API

This document outlines API responses for a cafe menu system with tagging, categories, and item variations.

## Public Endpoints

### List menu items with categories and tags

`GET /api/menu`

**Response**
```json
{
  "categories": [
    {
      "id": 1,
      "name": "Coffee",
      "items": [
        {
          "id": 101,
          "name": "Espresso",
          "image": "https://example.com/images/espresso.jpg",
          "tags": ["hot", "caffeine"],
          "variations": [
            {"id": 1001, "name": "Single Shot", "price": 3.0, "description": "30ml shot"},
            {"id": 1002, "name": "Double Shot", "price": 4.5, "description": "60ml shot"},
            {"id": 1003, "name": "Triple Shot", "price": 6.0, "description": "90ml shot"}
          ]
        }
      ]
    }
  ]
}
```

### Filter items by tag or category

`GET /api/items?tag=hot&category=coffee`

**Response**
```json
{
  "items": [
    {
      "id": 101,
      "name": "Espresso",
      "image": "https://example.com/images/espresso.jpg",
      "categories": [{"id":1, "name":"Coffee"}],
      "tags": ["hot", "caffeine"],
      "variations": [
        {"id": 1001, "name": "Single Shot", "price": 3.0, "description": "30ml shot"},
        {"id": 1002, "name": "Double Shot", "price": 4.5, "description": "60ml shot"}
      ]
    }
  ]
}
```

### Get a single item

`GET /api/items/{id}`

**Response**
```json
{
  "id": 101,
  "name": "Espresso",
  "description": "Strong coffee made by forcing steam through ground coffee beans.",
  "image": "https://example.com/images/espresso.jpg",
  "categories": [{"id":1, "name":"Coffee"}],
  "tags": ["hot", "caffeine"],
  "variations": [
    {"id": 1001, "name": "Single Shot", "price": 3.0, "description": "30ml shot"},
    {"id": 1002, "name": "Double Shot", "price": 4.5, "description": "60ml shot"}
  ]
}
```

## Admin Endpoints

### Create a category

`POST /admin/categories`

**Request**
```json
{"name": "Coffee"}
```

### Create a tag

`POST /admin/tags`

**Request**
```json
{"name": "hot"}
```

### Create an item with variations

`POST /admin/items`

**Request**
```json
{
  "name": "Espresso",
  "description": "Strong coffee",
  "image": "https://example.com/images/espresso.jpg",
  "category_ids": [1],
  "tag_ids": [1,2],
  "variations": [
    {"name": "Single Shot", "price": 3.0, "description": "30ml shot"},
    {"name": "Double Shot", "price": 4.5, "description": "60ml shot"}
  ]
}
```

### Update or delete entities

Admin can update or delete categories, tags, items and item variations using standard REST verbs:

- `PUT /admin/items/{id}`
- `DELETE /admin/items/{id}`
- `POST /admin/items/{id}/variations`
- `PUT /admin/items/{id}/variations/{variationId}`
- `DELETE /admin/items/{id}/variations/{variationId}`

These endpoints expect and return JSON bodies in the same shape as shown above.

