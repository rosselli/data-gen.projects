# Data-Gen
Data Generator application based on Profiles. 
Create a profile and generate your data in four formats _(csv, json, sql's insert, sqlite)_.

I described the reasons I developed this project in the article [What's the size of the data?]().

> A hidden advantage of the Data-Gen is to estimate the size of a given data structure can have in a database and in a request's payload.

## Usage
After ```git clone``` type on console ```php artisan rosselli:data-gen```.

![Artisan Commands](docs/data-gen-call.png)

Available commands.

![Artisan Commands](docs/commands.png)

## Profiles
Profile is the data's structure (schema) that will be generated.
For example, the Post schema is _**user_id, category_id, title, resume, text, image, caption, tags, created_at**_.

1. Create a class in ```App\Http\Controllers\Profiles```.
1. Extend Profile ```class Posts extends Profiles```.
1. Call Profile's constructor ```parent::__construct($records)```
1. Implement the Profile's abstract methods ```setTableName(), setFolderName(), generateData()```
1. With [Faker](https://github.com/fzaninotto/Faker) library, implement the schema.
![Schema](docs/schema.png) 

## Records
Data-Gen has six predefined sets of records to generate.

![Report](docs/records.png) 

If you want to customize the sets, edit ```app/Console/Commands/DataGen.php```

## Formats
Data-Gen generates data in CSV, JSON, SQL's Insert and Sqlite. 

## Storage
The data is generated in ```storage/app/data-gen/[profile]```. 

## Report
After generate the data, type on console ```php artisan rosselli:report```.

![Report](docs/report.png) 
