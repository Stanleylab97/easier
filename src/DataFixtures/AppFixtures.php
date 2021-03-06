<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Zone;
use App\Entity\Abonne;
use App\Entity\Agence;
use App\Entity\Facture;
use App\Entity\Guichet;
use App\Entity\Periode;
use App\Entity\Compteur;
use App\Entity\Bordereau;
use App\Entity\Categorie;
use App\Entity\Direction;
use App\Entity\Quittance;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $direction1=new Direction();
        $direction1->setCode("DRA");
        $direction1->setLibelle("Direction Régionale Atlantique");
        $manager->persist($direction1);
        $manager->flush();

        $direction2=new Direction();
        $direction2->setCode("DRL");
        $direction2->setLibelle("Direction Régionale Littoral");
        $manager->persist($direction2);
        $manager->flush();

        $direction3=new Direction();
        $direction3->setCode("DG");
        $direction3->setLibelle("Direction Générale");
        $manager->persist($direction3);
        $manager->flush();
       
        $agence0 = new Agence();
        $agence0->setLibelle("Agence Mobile Money");
        $agence0->setLon(3.62098);
        $agence0->setLat(2.11548);
        $agence0->setDirection($direction3);
        $manager->persist($agence0);
        $manager->flush();

        $agence1 = new Agence();
        $agence1->setLibelle("Agence Ganhi");
        $agence1->setLon(4.82098);
        $agence1->setLat(2.91748);
        $agence1->setDirection($direction2);
        $manager->persist($agence1);
        $manager->flush();

        

        $agence2 = new Agence();
        $agence2->setLibelle("Agence Godomey");
        $agence2->setLon(2.7187);
        $agence2->setLat(6.2548);
        $agence2->setDirection($direction1);
        $manager->persist($agence2);
        $manager->flush();

        $guichet1=new Guichet();
        $guichet1->setAgence($agence1);
        $guichet1->setNumero(1);
        $manager->persist($guichet1);
        $manager->flush();

        $guichet2=new Guichet();
        $guichet2->setAgence($agence2);
        $guichet2->setNumero(1);
        $manager->persist($guichet2);
        $manager->flush();

        $guichet3=new Guichet();
        $guichet3->setAgence($agence0);
        $guichet3->setNumero(1);
        $manager->persist($guichet3);
        $manager->flush();


        $zone1=new Zone();
        $zone1->setSigle("GD");
        $zone1->setLibelle("Godomey");
        $zone1->setAgence($agence2);
        $manager->persist($zone1);

        $zone2=new Zone();
        $zone2->setSigle("AK");
        $zone2->setLibelle("AKPAKPA");
        $zone2->setAgence($agence1);
        $manager->persist($zone2);
       

        $categorie1=new Categorie();
        $categorie1->setCode("01");
        $categorie1->setLibelle("Particulier");
        $manager->persist($categorie1);

        $categorie2=new Categorie();
        $categorie2->setCode("02");
        $categorie2->setLibelle("Entreprise");
        $manager->persist($categorie2);

        $categorie3=new Categorie();
        $categorie3->setCode("03");
        $categorie3->setLibelle("Administration");
        $manager->persist($categorie3);

        $manager->flush();

        $period1=new Periode();
        $period1->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period1->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period1->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period1->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period1);
        $manager->flush();
        
        $period2=new Periode();
        $period2->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period2->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period2->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period2->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period2);
        $manager->flush();

        $period3=new Periode();
        $period3->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period3->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period3->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period3->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period3);
        $manager->flush();

        $period4=new Periode();
        $period4->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period4->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period4->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period4->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period4);
        $manager->flush();

        $abonne1=new Abonne();
        $abonne1->setNom($faker->name);
        $abonne1->setAdresse($faker->streetName);
        $abonne1->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $abonne1->setTel(''.$faker->e164PhoneNumber);
        $abonne1->setCategorie($categorie1);
        $manager->persist($abonne1);
        $manager->flush();

        $abonne2=new Abonne();
        $abonne2->setNom($faker->name);
        $abonne2->setAdresse($faker->streetName);
        $abonne2->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $abonne2->setTel(''.$faker->e164PhoneNumber);
        $abonne2->setCategorie($categorie2);
        $manager->persist($abonne2);
        $manager->flush();

        $abonne3=new Abonne();
        $abonne3->setNom($faker->name);
        $abonne3->setAdresse($faker->streetName);
        $abonne3->setTel(''.$faker->e164PhoneNumber);
        $abonne3->setCategorie($categorie2);
        $abonne3->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $manager->persist($abonne3);
        $manager->flush();

        $abonne4=new Abonne();
        $abonne4->setNom($faker->name);
        $abonne4->setAdresse($faker->streetName);
        $abonne4->setTel(''.$faker->e164PhoneNumber);
        $abonne4->setCategorie($categorie3);
        $abonne4->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $manager->persist($abonne4);
        $manager->flush();

        for ($i = 0; $i < 6; $i++) {
            $bordereau = new Bordereau();
            $bordereau->setLibelle(''.$i+1);
            $bordereau->setQuartier($faker->city);
            $i%2?$bordereau->setZone($zone2):$bordereau->setZone($zone1);
            $manager->persist($bordereau);
            $manager->flush();
            
            for($i=0;$i<3;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice('GH'.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(10);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne1);
                $manager->persist($compteur);
                $manager->flush();

                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period1); 
                    $facture->setCompteur($compteur);
                    $facture->setTarif("B09");
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("Caisse");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId("NULL");
                        $quittance->setGuichet($guichet1);
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                }
            }
            
                $compteur=new Compteur();
                $compteur->setNumPolice('GD'.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(10);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne2); 
                $manager->persist($compteur);
                $manager->flush();
                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period2); 
                    $facture->setCompteur($compteur);
                    $facture->setTarif("BT1");
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("Caisse");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId("NULL");
                        $quittance->setGuichet($guichet2);
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                }
                
           
            for($i=0;$i<2;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice('GD'.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(15);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne3); 
                $manager->persist($compteur);
                $manager->flush();

                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period3); 
                    $facture->setCompteur($compteur);
                    $facture->setTarif("BT2");
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("MoMo");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId($faker->uuid);
                        $quittance->setGuichet($guichet3);
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                    
                    
                }
            }
            for($i=0;$i<10;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice('GH'.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(5);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne4); 
                $manager->persist($compteur);
                $manager->flush();
                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(9));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$min;
                        $min=$max;
                        $max=$x;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period4); 
                    $facture->setTarif("BT3");
                    $facture->setCompteur($compteur);
                    $manager->persist($facture);
                    $manager->flush();
                    
                    $quittance=new Quittance();
                    $quittance->setDateReglement($period1->getDateEcheance());
                    $quittance->setMoyen("MoMo");
                    $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                    $quittance->setFactureId($facture);
                    $quittance->setTransactionId($faker->uuid);
                    $quittance->setGuichet($guichet3);
                    $manager->persist($quittance);
                    $manager->flush();
                }
            }

       
        }

      

       


    }
}
