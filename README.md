
 ### **Instruction**

If you have installed docker and docker compose  in your pc
then after clone the project just goto the project root folder then run this command

./setup

Enter your root password 

After complete installation

<br>

***Frontend Browse :  http://localhost:8000***

***Api documentation :  http://localhost:8000/api/documentation***

***Backend Browse :  http://localhost:8000/api***

***Database Browse :  http://localhost:8085***

***Database Credentials :  System= PostgresSQL, Server=database,  username=postgres,  password=secret*** 

<br>
<br>


For check Backend API check Postman collection

- Room_Reservation.postman_collection.json
- Room-reservation-dev.postman_environment.json



Also you can create by Docker command
 
 - docker-compose up -d --build

Without docker you can install this project by this 
 
- php composer install

- php artisan migrate --seed

***Publish Documentation***

- docker-compose exec app php artisan l5-swagger:generate

***Run Lint***

- composer phplint

***Run Phpcs***

- composer phpcs

***Run Phpcbf***

- composer phpcbf

<br>
<br>

***For Backend API check Postman collection***

 - Pocket.postman_collection.json
 - POCKET.postman_environment.json
 
 
 
***Extra Question Answer***

- Say, the content site got hacked, therefore when fetching the content URL for
  content parsing it can keep redirecting, how to solve this scenario?
 - Answer: 
      - Check the http response code.
      - Maintaining a history.
 
 - Say, the content site got hacked, therefore when fetching the content URL for
   content parsing it can inject virus / malware / adware. how to guard this?
  - Answer: 
    -   Create a pattern database replace all 
        content which match with this content form database
    -   Use Regular expression matching.
  
  
  - Say, that URL can contain NSFW contents, how to flag NSFW? so that those
    don't get included in the suggestion system we may develop in future?
   - Answer: 
