
# Project 3
+ By: Caroline Im
+ Production URL: <http://e15p3.caroli.me>

## Feature summary

+ Visitors can register/log in
+ Users can add/update/delete minerals (minerals, countries, formulas, type localities)
+ Users can add/update repositories (full name, display name, country) 
+ Users can add/update type specimens (mineral name, publication, publication year, ima reference number, catalogue entry, type of type specimen, and comments )

  
## Database summary

+ My application has 5 tables in total (`minerals`, `repositories`, `countries`, `specimens`, `users`)
+ There's a one-to-many relationship between `minerals` and `countries`
+ There's a one-to-many relationship between `repositories` and `countries`
+ There's a one-to-many relationship between `specimens` and `countries`

+ There's a one-to-many relationship between `specimens` and `minerals`
+ There's a one-to-many relationship between `specimens` and `repositories`


## Outside resources
https://stackoverflow.com/questions/21388402/fade-out-after-div-content-has-been-shown-using-css

## Notes for instructor
I got a little too ambitious with the table relationships.
