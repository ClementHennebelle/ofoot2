<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Club;
use App\Entity\Tournament;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $clubObjectList = $this->loadClubs($manager);
        $tournamentObjectList = $this->loadTournaments($manager);
    } 
    private function loadTournaments (ObjectManager $manager) {
        $tournaments = [
            'name' => 'Tournoi du FC Paris',
            'date' => '2024-04-04',
            'price' => '15',
            'rewards' => 'trophée',
            'nombre équipes'=> '16',
            'nombre joueurs' => '12',
            'location' => 'Paris',
            'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE'

        ];
        $createdTournaments = [];
        foreach($tournaments as $currentTournament)
    {
        $newTournament = new Tournament();
        $newTournament->setTournamentName($currentTournament);


        $createdTournaments[] = $newTournament;
        $manager->persist($newTournament);

        $manager->flush();

        return $createdTournaments;
    }
    }

        /* CLUBS **/
private function loadClubs(ObjectManager $manager)
{
    $clubs = [
        'Champigny Football Club',
        'Herblay Foot',
        'Football Club Municipal de Vincennes',
        'Bourges Football Club',
        'Caen Foot Club',
        'Union Sportive de Clichy',
    ];

    $createdClubs = [];
    foreach($clubs as $currentClub)
    {
        $newClub = new Club();
        $newClub->setClubName($currentClub);


        $createdClubs[] = $newClub;
        $manager->persist($newClub);
    }

    $manager->flush();

    return $createdClubs;
}


}
