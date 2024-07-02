# Application routes
| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Welcome to O'Foot| Home Page |
| `/tournament` | `GET`        | `TournamentController` | `browse`  | List of tournaments | - |
| `/tournament/{id}` | `GET`        | `TournamentController` | `read`  | Tournament details |
| `/faq` | `GET`        | `TournamentController` | `faq`  | FAQ | - |
| `/contact` | `GET`        | `TournamentController` | `contact`  | contact | - |
| `/profile` | `GET`        | `TournamentController` | `profile`  | profile | - |
| `/profil/registration` | `GET`        | `TournamentController` | `registration`  | register for a tournament | - |
| `/profil/registration` | `POST`        | `TournamentController` | `registration`  | Form processing | - |


## Back Office

| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/back/` | `GET`        | `MainController` | `home`  | Welcome to the tournament backoffice  | Home Page |
| `/back/tournament/` | `GET`        | `TournamentController` | `browse`  | Tournament administration | List of tournaments |
| `/back/tournament/{id}` | `GET`        | `TournamentController` | `read`  | Viewing a tournament  | Tournament details |
| `/back/tournament/{id}/edit` | `GET`, `POST`        | `TournamentController` | `edit`  | Edit a tournament | Poster / processes the edit form |
| `/back/tournament/add` | `GET`, `POST`        | `tournamentController` | `add`  | Add a tournament |  Poster /  processes the add form |
| `/back/tournament/{id}/delete` | `GET`        | `TournamentController` | `delete`  | - | Delete the tournament  |

## Teams

| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/back/team` | `GET`        | `MainController` | `home`  | Welcome to the team backoffice | Home Page |
| `/back/team/` | `GET`        | `TeamController` | `browse`  | Team administration | Team list |
| `/back/team/{id}` | `GET`        | `TeamController` | `read`  | Viewing a team | Team details|
| `/back/team/{id}/edit` | `GET`, `POST`        | `TeamController` | `edit`  | Edit a team | Poster / processes the edit form |
| `/back/team/add` | `GET`, `POST`        | `TeamController` | `add`  | Add a team | Poster / processes the add form |
| `/back/team/{id}/delete` | `GET`        | `TeamController` | `delete`  | - | Delete a team  |
