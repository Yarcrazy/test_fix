Task description is provided in the task.pdf file.

How to run:
1. Clone repository.  
  ``git clone git@github.com:Yarcrazy/test_fix.git``
2. Up docker:  
  ``docker compose up -d``
3. Install dependencies:  
  ``docker exec -it app composer install --working-dir=app``
4. Do migrations:  
  ``docker exec -it app php app/yii migrate``
5. Use:  
  POST **http://localhost:9234/calculate-bonus**

Optionnally:
1. Swagger documentation
  **http://localhost:9234/docs**

Run tests:  
``docker exec -it app bash -c "cd app && ./vendor/bin/codecept run unit"``
