# FRONT
| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Welcome to O'Foot| Home Page |
| `/faq` | `GET`        | `MainController` | `app_main_faq`  | a definir| a definir |
| `/about` | `GET`        | `MainController` | `app_main_about`  | a definir| a definir |
| `/cgu` | `GET`        | `MainController` | `app_main_cgu`  | a definir| a definir |
| `/tournament` | `GET`        | `TournamentController` | `app_tournament_browse`  | a definir| a definir |
| `/tournament/{id}` | `GET`        | `TournamentController` | `app_tournament_read`  | a definir| a definir |
| `/tournament/{id}/score/` | `GET`        | `TournamentController` | `app_tournament_score`  | a definir| a definir |
| `/tournament/{id}/games` | `GET`        | `TournamentController` | `app_tournament_games`  | a definir| a definir |
| `/create` | `GET`   `POST`     | `TournamentController` | `app_create_tournament`  | a definir| a definir |
| `/tournament/{id}/register` | `GET`      | `TournamentController` | `app_tournament_register`  | a definir| a definir |
| `/tournament/{id}/new-game` | `GET`      | `GameController` | `app_game_new`  | a definir| a definir |
| `/contact` | `GET`      | `ContactController` | `app_contact`  | a definir| a definir |
| `/club` | `GET`        | `ClubController` | `app_club_read`  | a definir| a definir |
| `/club/add` | `GET`  `POST`      | `ClubController` | `app_club_add`  | a definir| a definir |
| `/createclub` | `GET`  `POST`      | `ClubController` | `app_club_create_club`  | a definir| a definir |

## BACK
| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/club/back/` | `GET`        | `ClubBackController` | `app_club_back_index`  | a definir | a definir |
| `/club/back/new` | `GET`  `POST`       | `ClubBackController` | `app_club_back_new`  | a definir | a definir |
| `/club/back/{id}` | `GET`        | `ClubBackController` | `app_club_back_show`  | a definir | a definir |
| `/club/back/{id}/edit` | `GET`  `POST`       | `ClubBackController` | `app_club_back_edit`  | a definir | a definir |
| `/club/back/{id}` | `POST`        | `ClubBackController` | `app_club_back_delete`  | a definir | a definir |
| `/tournament/back/` | `GET`        | `TournamentBackController` | `app_tournament_back_index`  | a definir | a definir |
| `/tournament/back/new` | `GET`  `POST`       | `TournamentBackController` | `app_tournament_back_new`  | a definir | a definir |
| `/tournament/back/{id}` | `GET`        | `TournamentBackController` | `app_tournament_back_show`  | a definir | a definir |
| `/tournament/back/{id}/edit` | `GET`  `POST`       | `TournamentBackController` | `app_tournament_back_edit`  | a definir | a definir |
| `/tournament/back/score/{id}` | `POST`        | `TournamentBackController` | `app_tournament_back_delete`  | a definir | a definir |
| `/register` | `GET`        | `RegistrationController` | `app_register`  | a definir | a definir |
| `/verify/email` | `GET`        | `RegistrationController` | `app_verify_email`  | a definir | a definir |
| `/reset-password` | `GET`        | `ResetPasswordController` | `app_forgot_password_request`  | a definir | a definir |
| `/reset-password/check-email` | `GET`        | `ResetPasswordController` | `app_check_email`  | a definir | a definir |
| `/reset-password/reset/{token}` | `GET`        | `ResetPasswordController` | `app_reset_password`  | a definir | a definir |
| `/tournament/{id}/register` | `GET`        | `TournamentRegistrationController` | `app_tournament_register_process`  | a definir | a definir |

#### API
| URL | Method HTTP | Controller       | Method | Title HTML           | Comments    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/api/game/` | `GET`        | `GameController` | `app_score`  | a definir | a definir |
| `/api/game/{id}` | `PATCH`        | `GameController` | `score_update`  | a definir | a definir |
