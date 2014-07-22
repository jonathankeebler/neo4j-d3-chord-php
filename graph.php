<?php

use Everyman\Neo4j\Client;
use Everyman\Neo4j\Batch;
use Everyman\Neo4j\Index;
use Everyman\Neo4j\Cypher\Query;

class Graph {

	protected static $nodes = array();
	protected $client = null;

	public function __construct() {
		$this->client = new Client("localhost", 7474);
	}

	public function create() {
		
	}

	public function matrix() {
		$queryString = " MATCH (a:Person)-[*1..3]-(b:Person) " . 
			" WHERE a <> b " . 
			" RETURN a.name, collect(DISTINCT b.name) " .
			" LIMIT 100 ";
	
		$queryString = " MATCH (a:Person)-[:POSTED]->(:Tweet)-[:USED]->(:Word)<-[:USED]-(:Tweet)<-[:POSTED]-(b:Person) " . 
			" WHERE a <> b " . 
			" RETURN a.name, collect(DISTINCT b.name) " .
			" LIMIT 100 ";
			

		$query = new Query($this->client, $queryString);
		return $query->getResultSet();
	}
}