<?php

require_once (File::build_path(array('lib', 'QueryBuilder.php')));

class ControllerTest {

	protected static $object = "test";

    public function test1 () {

        //------------------------------------------------------------------------------------------------
        
                $myRequest = new QueryBuilder;
        
                $myRequest->count('*', 'nb_number_count')
                          ->from('table1', 'I')
                          ->rightOuterJoin('table2', 'Alias2', 'alias1', 'attribut1', 'attribut2')
                          ->where('prix', '=', 10)
                          ->orderBy('prix', 'DESC')
                          ->limit(10)
                          ->offset(20);
        
                $test = $myRequest->getSQL();
        
                echo $test;
        
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
        
                $myRequest2 = new QueryBuilder;
        
                $myRequest2->select('*')
                          ->from('produit', 'P')
                          ->join('categorisation', 'C', 'P', 'id_produit', 'id')
                          ->join('categorie', 'CA', 'C', 'id', 'id_categorie')
                          ->where('prix', '=', 10)
                          ->orderBy('prix', 'DESC')
                          ->limit(10)
                          ->offset(20);
            
                echo $myRequest2->getSQL();
            
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
            
                $myRequest3 = new QueryBuilder;
        
                $myRequest3->count('id')
                           ->from('produit', 'P');
            
                echo $myRequest3->getSQL();
            
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
            
                $myRequest4 = new QueryBuilder;
        
                $myRequest4->select(array('id', 'description', 'id'), array('P', 'P', 'P'));
            
                echo $myRequest4->getSQL();
            
        //------------------------------------------------------------------------------------------------
                
                echo "<br>";
        
                //$query = QueryBuilder::from('produit', 'p');
                //->orderBy('prix', 'DESC')->limit(10)::getSQL();
                //var_dump($query);
                //echo $query;
                //echo '1';
                //echo $myRequest;
        
            }

}

?>