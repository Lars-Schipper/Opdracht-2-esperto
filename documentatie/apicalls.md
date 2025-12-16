welke api calls moeten er allemaal zijn?

usertabel: 
1. je moet een user zijn gegevens kunnen ophalen
    - api/user/{id}
    - method: GET
2. je moet een user kunnen toevoegen
    - api/user
    - method: POST
3. je moet een user kunnen aanpassen
    - api/user/{id}
    - method: PUT
4. je moet een user kunnen verwijderen
    - api/user/{id}
    - method: DELETE

tasklisttable:
1. je moet kunnen zien welke tasklists er allemaal zijn
    - api/tasklists/all
    - method: GET
2. je moet een nieuwe tasklist kunnen maken
    - api/tasklists
    - method: POST
3. je moet de tasklist kunnen aanpassen
    - api/tasklists
    - method: POST
4. je moet de eigenaar van de tasklist kunnen wijzigen
    - api/tasklists/{id}
    - method: PUT
5. je moet de task list kunnen verwijderen
    - api/tasklists/{id}
    - method: DELETE
6. je moet members kunnen toewijzen aan de tasklsit
    - api/tasklists/{id}/member{memberid}
    - method: PUT

tasktable: 
1. je moet alle task kunnen inzien
    - api/tasks
    - method: GET
2. je moet een nieuwe task kunnen creeeren
    - api/tasks
    - method: POST
3. je moet de task kunnen aanpassen
    - api/tasks/{id}
    - method: PUT
4. je moet de task status kunnen wijzigen
    - api/tasks/{id}/status
    - method: PUT
5. je moet de task kunnen verwijderen
    - api/tasks/{id}
    - method: DELETE