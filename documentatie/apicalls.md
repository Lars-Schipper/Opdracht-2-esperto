welke api calls moeten er allemaal zijn?

goed na denken met het schrijven van de api's

usertabel:
0. je moet alle users gegevens ophalen
    - api/users
    - method: GET
1. je moet een user zijn gegevens kunnen ophalen
    - api/users/{id}
    - method: GET
2. je moet een user kunnen toevoegen
    - api/users
    - method: POST
3. je moet een user kunnen aanpassen
    - api/users/{id}
    - method: PATCH
4. je moet een user kunnen verwijderen
    - api/users/{id}
    - method: DELETE
5. geeft alle taskslists van een bepaalde user waar hij owner/ creator is
    - api/users/{id}/tasklists
    - method: GET
6. geeft alle tasks van een bepaalde user terug waar hij toegewezen is
    - api/users/{id}/tasks
    - method: GET

tasklisttable:
1. je moet kunnen zien welke tasklists er allemaal zijn
    - api/tasklists
    - method: GET
2. je moet een enkele tasklist kunnen ophalen
    - api/tasklists/{id}
    -method: GET
2. je moet een nieuwe tasklist kunnen maken
    - api/tasklists
    - method: POST
3. je moet de tasklist kunnen aanpassen
    - api/tasklists/{id}
    - method: PATCH
5. je moet de task list kunnen verwijderen
    - api/tasklists/{id}
    - method: DELETE
6. je wilt een lijst van alle users die zijn toegewezen aan de task van tasklist
    - api/tasklists/{id}/users
    - method: GET

tasktable: 
1. je moet alle task kunnen inzien
    - api/tasks
    - method: GET
2. je moet een nieuwe task kunnen creeeren
    - api/tasks
    - method: POST
3. je moet de task kunnen aanpassen
    - api/tasks/{id}
    - method: PATCH
5. je moet de task kunnen verwijderen
    - api/tasks/{id}
    - method: DELETE
6. je wilt alle users van een task zien
    - api/tasks/{id}/users
    - method: GET
7. je wilt users aan een task toevoegen
    - api/tasks/{id}/users/{userid}
    - method: POST
8. je wilt de users van een task aan passen
    - api/tasks/{id}/users/{userid}
    - method: PATCH
9. je wilt een user verwijderen van de task
    - api/tasks/{id}/users/{userid}
    - method: DELETE
10. om alle users van een task te verwijderen
    - api/tasks/{id}/users
    - method: DELETE