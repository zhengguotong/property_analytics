#  Property Analytics

## Docker Configuration

### .env
Create an `.env` file from `.env.example`
```bash
cp .env.example .env

# Customize every variable according to your needs
# See comments to each variable in .env.example file
```
### Docker Containers list 
- property_fpm   PHP FPM container 
- property_nginx Nginx Container
- property_db DD Container

## API Endpoint

### Add a new property 
**URL** : `/api/properties`

**Method** : `POST`
#### Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "suburb":"Gladesville",
    "state": "NSW",
    "country": "Australia"
}
```

### Add/Update an analytic to a property
**URL** : `/api/properties/{property}/analytics`

**Method** : `POST`
#### Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "value": "11",
    "analytic_type_id": 2
}
```
#### Notes

* If the property does not have an analytic type will create new analytic for this property
otherwise will update the analytic instead

### Get all analytics for an inputted property
**URL** : `/api/properties/{property}/analytics`

**Method** : `GET`
#### Success Response

**Code** : `200 OK`

**Response examples**

```json
{
    "data": [
        {
            "analytic_name": "max_Bld_Height_m",
            "analytic_unit": "m",
            "value": "21"
        },
        {
            "analytic_name": "min_lot_size_m2",
            "analytic_unit": "m2",
            "value": "340"
        },
        {
            "analytic_name": "fsr",
            "analytic_unit": ":1",
            "value": "1.270018421"
        }
    ]
}
```

### Get a summary of all property analytics for an inputted suburb/state/country

Get a summary of all property analytics for an inputted suburb/state/country (min value, max value, median value, percentage properties with a value, percentage properties without a value)

**URL** : `api/properties/analytics/search`

**Request Params** : 
* suburb eg. `suburb=Parramatta`
* state eg. `state=vic`
* country eg. `country=Australia`

**Method** : `GET`
#### Success Response

**Code** : `200 OK`

**Response examples**

```json
{
    "data": [
        {
            "units": "m",
            "analytic_name": "max_Bld_Height_m",
            "min_value": "9",
            "max_value": "37",
            "median_value": "19.0",
            "percentage_properties_with_value": "1.00",
            "percentage_properties_without_value": "0.00"
        },
        {
            "units": "m2",
            "analytic_name": "min_lot_size_m2",
            "min_value": "225",
            "max_value": "1067",
            "median_value": "790",
            "percentage_properties_with_value": "0.67",
            "percentage_properties_without_value": "0.33"
        },
        {
            "units": ":1",
            "analytic_name": "fsr",
            "min_value": "0.628650031",
            "max_value": "3.412101376",
            "median_value": "1.77",
            "percentage_properties_with_value": "0.50",
            "percentage_properties_without_value": "0.50"
        }
    ]
}
```

## CI & Unit Test
This Project using github action as simple CI tools

## Notes
* source code is under api folder
