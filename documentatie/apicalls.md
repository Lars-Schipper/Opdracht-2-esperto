welke api calls moeten er allemaal zijn?

usertabel: 
1. je moet een user zijn gegevens kunnen ophalen
    - database/user/{id}
    - method: GET
2. je moet een user kunnen toevoegen
    - database/user
    - method: POST
3. je moet een user kunnen aanpassen
    - database/user/{id}
    - method: PUT
4. je moet een user kunnen verwijderen
    - database/user/{id}
    - method: DELETE

tasklisttable:
1. je moet kunnen zien welke tasklists er allemaal zijn
    - database/tasklists/all
    - method: GET
2. je moet een nieuwe tasklist kunnen maken
    - database/tasklists
    - method: POST
3. je moet de tasklist kunnen aanpassen
    - database/tasklists
    - method: POST
4. je moet de eigenaar van de tasklist kunnen wijzigen
    - database/tasklists/{id}
    - method: PUT
5. je moet de task list kunnen verwijderen
    - database/tasklists/{id}
    - method: DELETE
6. je moet members kunnen toewijzen aan de tasklsit
    - database/tasklists/{id}/member{memberid}
    - method: PUT

tasktable: 
1. je moet alle task kunnen inzien
    - database/tasks
    - method: GET
2. je moet een nieuwe task kunnen creeeren
    - database/tasks
    - method: POST
3. je moet de task kunnen aanpassen
    - database/tasks/{id}
    - method: PUT
4. je moet de task status kunnen wijzigen
    - database/tasks/{id}/status
    - method: PUT
5. je moet de task kunnen verwijderen
    - database/tasks/{id}
    - method: DELETE