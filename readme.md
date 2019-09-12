### remarks

> _when importing it will not check if the player is already in the database as for the instruction if needed we can just use firstOrCreate , another thing is that the player id in the database have there own id `player_id` , if for API authentication i can easily use PASSPORT , for the design i used Repository patter(database transaction and other function  / or use eloquent)  and added the service layer (for non database transaction)._


 > _another thing is that i can use this package https://github.com/jarektkaczyk/eloquence (docu : https://github.com/jarektkaczyk/eloquence/wiki/Mappable)so we can easily map
change field from response from API._



### Installing
* clone the repo and run 
```shell
	composer install
```

### Migrate Database
```shell
	php artisan migrate
```
### Running process
* type or copy
```shell
	php artisan playerAPI:import 
```
 * it will output result if success or failed import

### Running Unit Test
* go to root folder
* type
```shell
	./vendor/bin/phpunit --testdox
	or
	vendor\bin\phpunit --testdox
```

### Package used
---
* l5 Repository : `https://github.com/andersao/l5-repository` 
    - a very help full package will generate repo pattern and some major functionality for end points
* Ixudra Curl : `https://github.com/ixudra/curl`
    - help full curl function which have many options, if you need response to array or JSON

### Files used in the Process cash transaction
---
##### Main file (App/Console/Commands)
* `ImportPlayerDataFromAPI.php` : This will be called when run the command in the console or add to Cron jobs.

##### Repository (App/Repositories)
*  `PlayerRepository.php` : Interface for the repo which we can used for dependency injection.
*  `PlayerRepositoryEloquent.php` : all the logic and processing methods are inside.

##### Services (App/Services)
*  `PlayerAPI/PlayerServices.php` : Interface for the service.
*  `PalyerAPI/PlayerServicesJSON.php` : methods calling outbound API which implements PlayerServices so we can change From json to XML without missing some required functionality.
### Unit Testing
----------
##### Unit Test (test/Unit
* `PlayerFunctionalityTest.php` : This will check the full process of importing data from API to Database.

##### Feature Test (test/Feature
* `PlayersAPITest.php` : Testing if the service for fetching the players to be imported.
* `PlayersEndPointTest.php` : Will test the fetching of the players from our end point.
* 
### End points
----------
> _l5 repository have a good functionality when generating end points, it will automatically create Resource controller,
and a URL Criteria maker for fetching data, check the documentation for further use._

##### Fetching all players from end point
* well get all the player from our database
`http://localhost:8000/api/player`
_Sample result_:
 
```
   {
    "data": [
        {
            "id": 544,
            "chance_of_playing_next_round": null,
            "chance_of_playing_this_round": null,
            "code": 69140,
            "now_cost": 53,
            "cost_change_event": -1,
            "cost_change_event_fall": 1,
            "cost_change_start": -2,
            "cost_change_start_fall": 2,
            "dreamteam_count": 0,
            "element_type": 2,
            "ep_next": "0.50",
            "ep_this": "0.00",
            "event_points": 0,
            "first_name": "Shkodran",
            "second_name": "Mustafi",
            "form": "0.00",
            "player_id": 1,
            "in_dreamteam": 0,
```

* if you want to filter the result and get the Id or Player Id , first name , second name etc.
`http://localhost:8000/api/player?filter=player_id;first_name;second_name`
_Sample result:_
```
{
    "data": [
        {
            "player_id": 1,
            "first_name": "Shkodran",
            "second_name": "Mustafi"
        },
        {
            "player_id": 2,
            "first_name": "Héctor",
            "second_name": "Bellerín"
        },
        {
            "player_id": 3,
            "first_name": "Sead",
            "second_name": "Kolasinac"
        },
```


##### Fetching specific players by player id from end point
* well get all the information player specific  from our database
`http://localhost:8000/api/player/50`
_Sample result_:
 
```
  {
    "data": [
        {
            "id": 642,
            "chance_of_playing_next_round": null,
            "chance_of_playing_this_round": null,
            "code": 165210,
            "now_cost": 58,
            "cost_change_event": -1,
            "cost_change_event_fall": 1,
            "cost_change_start": -2,
            "cost_change_start_fall": 2,
            "dreamteam_count": 0,
            "element_type": 3,
            "ep_next": "-0.50",
            "ep_this": "-1.50",
            "event_points": 0,
            "first_name": "Alireza",
            "second_name": "Jahanbakhsh",
            "form": "0.00",
            "player_id": 50,
            "in_dreamteam": 0,
            "news": "",
            "news_added": null,
            "photo": "165210.jpg",
            "points_per_game": "0.00",
            "selected_by_percent": "0.10",
            "special": 0,
```

* if you want to filter the result and only show some specific cdata.
`http://localhost:8000/api/player/50?filter=player_id;first_name;second_name;form;total_points;influence;creativity;threat;ict_index`
_Sample result:_
```
{
    "data": [
        {
            "player_id": 50,
            "first_name": "Alireza",
            "second_name": "Jahanbakhsh",
            "form": "0.00",
            "total_points": 0,
            "influence": "0.00",
            "creativity": "0.00",
            "threat": "0.00",
            "ict_index": "0.00"
        }
    ]
}
```

