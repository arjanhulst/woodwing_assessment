# WoodWing
Assessment for WoodWing
## Goal
The goal is to create a RESTful API which adds up 2 distances of varying units.

## Approach
### Technical
**Note** 

I'm aware that there are bundles and libraries that supply various features like:
* https://api-platform.com/
* https://github.com/olifolkerd/convertor

However using those seems (to me at least) defeat the purpose of a coding test. I do use some bundles (see Technical below)

**EndNote**

For this assessment I will use Symfony (latest) as framework
Nelmio ApiDocBundle for providing api features
JMS Serializer for serialization

### General
The challenge here is to convert units back and forth, and convert them to the requested unit type. 
My solution is to always convert back the supplied units in the request to meters and convert them to the requested unit type. 
The way this works is we create models for each unit that we want to convert to, and supply that model with the ratio against meters. That way, we can always add and convert units with that model. 
It also makes it easier to add more units (models) in the future, as you would only have to add a new model with the correct ratio and name.

### Logic
As stated above the plan is to create a few simple models that will supply us with the calculation features. 
The gross of functions will be supplied within a Base Model, while the unit specific functions (if any) will be supplier by the particular models.
For instantiating the models a factory will be used.
The business logic will be supplied by a Service, which handles all the calculation steps.

### Steps
I suspect the following steps will be required to get a MVP:
* Initial Setup (Install Symfony and required bundles)
* Create a controller with basic functionality and corresponding tests
* Handle GET (and/or) POST requests with data and corresponding tests
* Create the models / entities and corresponding tests
* Create the factory which instantiates models and corresponding tests
* Create the Service which contains most of the business logic and off course tests

Nice to haves:
* Extended error reporting / handling
* More robust input verification (types, etc)

## Endpoint
Getting ahead of myself here, this is a placeholder, but this is how it will work in the end. More or less..
##### /api/add-up-distance (either POST or GET)
```
[
    [
        'distance' => 5,
        'unit' => 'meter'
    ],
    [
        'distance' => 3,
        'unit' => 'yard'
    ],
    'returnUnit' => 'yard'
 ]
```
