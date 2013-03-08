<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class XMLContent extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('CMSVideos_model');
		$this->load->model('CMSFotos_model');
		$this->load->helper('xml');
	}

	/*
	* NOTICIAS
	*/
	public function getNews()
	{
		$this->load->model('CMSNoticias_model');
		$newsData = $this->CMSNoticias_model->getList(1);

		$dom = new DOMDocument("1.0", "utf-8");
		$dom->formatOutput = true;

		$data = $dom->createElement("data");


		foreach ($newsData->result() as $row):

			$date = date("d-m-Y", strtotime($row->date));
			$source = $row->source;

			$pt = $dom->createElement("pt");
			$en = $dom->createElement("en");
			$es = $dom->createElement("es");

			$item = $dom->createElement("item");
			$item->setAttribute('date', $date . " - " . $source);

				$titleContents = $dom->createCDATASection($row->title);
				$title = $dom->createElement("title");
				$title->appendChild($titleContents);

				$descriptionContents = $dom->createCDATASection($row->contents);
				$description = $dom->createElement("description");
				$description->appendChild($descriptionContents);

			$item->appendChild($pt);
			$item->appendChild($en);
			$item->appendChild($es);
			$pt->appendChild($title);
			$pt->appendChild($description);
			$data->appendChild($item);

		endforeach;

		$dom->appendChild($data);
		header("Content-Type: text/xml");
		print $dom->saveXML();
	}

	/*
	* FOTOS
	*/
	public function getPhotos()
	{
		$this->load->model('CMSFotos_model');
		$imagesData = $this->CMSFotos_model->getImages();

		$dom = new DOMDocument("1.0", "utf-8");
		$dom->formatOutput = true;

		$data = $dom->createElement("data");

		foreach ($imagesData->result() as $row):

			$item = $dom->createElement("image");
			$item->setAttribute('id', $row->id);
			$item->setAttribute('thumb', $row->thumbFilename);
			$item->setAttribute('full', $row->filename);

			$data->appendChild($item);

		endforeach;

		$dom->appendChild($data);
		header("Content-Type: text/xml");
		print $dom->saveXML();
	}

	/*
	* VÍDEO
	*/
	public function getVideos()
	{
		$this->load->model('CMSVideos_model');
		$videoData = $this->CMSVideos_model->getVideos();

		$dom = new DOMDocument("1.0", "utf-8");
		$dom->formatOutput = true;

		$data = $dom->createElement("data");

		foreach ($videoData->result() as $row):

			$pt = $dom->createElement("pt");
			$en = $dom->createElement("en");
			$es = $dom->createElement("es");

			$item = $dom->createElement("item");
			$item->setAttribute('id', $row->thumbFilename);
			$item->setAttribute('video', $row->filename);

				$descriptionContents = $dom->createCDATASection($row->description);

			$item->appendChild($pt);
			$item->appendChild($en);
			$item->appendChild($es);
			$pt->appendChild($descriptionContents);
			$data->appendChild($item);

		endforeach;

		$dom->appendChild($data);
		header("Content-Type: text/xml");
		print $dom->saveXML();
	}
	
	/*
	* FOOTER
	*/
	public function getFooter()
	{
		$this->load->model('CMSBanners_model');
		$clubData = $this->CMSBanners_model->getClubBanner();

		$dom = new DOMDocument("1.0", "utf-8");
		$dom->formatOutput = true;

		$data = $dom->createElement("data");
		
		$box = $dom->createElement("box");
		$box->setAttribute('id', 'twitter');
		$box->setAttribute('width', '330');
		$box->setAttribute('height', '58');
		$box->setAttribute('right', '');
		$box->setAttribute('left', '120');
		$box->setAttribute('path', '');
		$data->appendChild($box);
		
		$team = $dom->createElement("box");
		$team->setAttribute('id', 'team');
		$team->setAttribute('width', '58');
		$team->setAttribute('height', '58');
		$team->setAttribute('right', '440');
		$team->setAttribute('left', '');
		$team->setAttribute('path', $clubData["filename"]);
		$team->setAttribute('link', $clubData["link"]);
		$data->appendChild($team);
		
		$brand1 = $dom->createElement("box");
		$brand1->setAttribute('id', 'brand1');
		$brand1->setAttribute('width', '255');
		$brand1->setAttribute('height', '58');
		$brand1->setAttribute('right', '125');
		$brand1->setAttribute('left', '');
		$brand1Data = $this->CMSBanners_model->getBanners(2);
		$data->appendChild($brand1);
		
		foreach ($brand1Data->result() as $row):
			$item = $dom->createElement("item");
			$fileNode = $dom->createElement("filename");
			$filename = $dom->createCDATASection($row->filename);
			$fileNode->appendChild($filename);
			$linkNode = $dom->createElement("link");
			$link = $dom->createCDATASection($row->link);
			$linkNode->appendChild($link);
			$item->appendChild($fileNode);
			$item->appendChild($linkNode);
			$brand1->appendChild($item);
		endforeach;
		
		$brand2 = $dom->createElement("box");
		$brand2->setAttribute('id', 'brand2');
		$brand2->setAttribute('width', '105');
		$brand2->setAttribute('height', '58');
		$brand2->setAttribute('right', '15');
		$brand2->setAttribute('left', '');
		$brand2Data = $this->CMSBanners_model->getBanners(3);
		$data->appendChild($brand2);
		
		foreach ($brand2Data->result() as $row):
			$item = $dom->createElement("item");
			$fileNode = $dom->createElement("filename");
			$filename = $dom->createCDATASection($row->filename);
			$fileNode->appendChild($filename);
			$linkNode = $dom->createElement("link");
			$link = $dom->createCDATASection($row->link);
			$linkNode->appendChild($link);
			$item->appendChild($fileNode);
			$item->appendChild($linkNode);
			$brand2->appendChild($item);
		endforeach;

		$dom->appendChild($data);
		header("Content-Type: text/xml");
		print $dom->saveXML();
	}

	/*
	 * STATS
	 */
	public function getStats()
	{
		$index = 0;
		$colors = array('0x18A7B8', '0xA5DA0C', '0xEBDA08', '0x868684', '0xE8B824', '0xC54B2F');
		$this->load->model('CMSTorneios_model');
		$tournamentStatsData = $this->CMSTorneios_model->getList(1);
		$seasonsStatsData = $this->CMSTorneios_model->getSeasons();

		$dom = new DOMDocument("1.0", "utf-8");
		$dom->formatOutput = true;

		$data = $dom->createElement("data");
		$stats = $dom->createElement("stats");
		$general = $dom->createElement("general");
		$currentSeason = $dom->createElement("currentSeason");
		$tournaments = $dom->createElement("tournaments");

		// Seasons Stats
		foreach ($seasonsStatsData->result() as $row):
			$year = $dom->createElement("year");
			$year->setAttribute('id', $row->season);
			$general->appendChild($year);

			$seasonClubStats = $this->CMSTorneios_model->getSeasonStats($row->season, 1);
			$seasonNationalStats = $this->CMSTorneios_model->getSeasonStats($row->season, 0);

			$club = $dom->createElement("club");
			$club->setAttribute('goals', $seasonClubStats[0]['goals'] == "" ? "0" : $seasonClubStats[0]['goals']);
			$club->setAttribute('matches', $seasonClubStats[0]['matches'] == "" ? "0" : $seasonClubStats[0]['matches']);
			$club->setAttribute('assists', '0');
			
			$nationalteam = $dom->createElement("nationalteam");
			$nationalteam->setAttribute('goals', $seasonNationalStats[0]['goals'] == "" ? "0" : $seasonNationalStats[0]['goals']);
			$nationalteam->setAttribute('matches', $seasonNationalStats[0]['matches'] == "" ? "0" : $seasonNationalStats[0]['matches']);
			$nationalteam->setAttribute('assists', '0');

			$year->appendChild($club);
			$year->appendChild($nationalteam);
		endforeach;

		// Current season stats
		$currentSeasonStats = $this->CMSTorneios_model->getCurrentSeasonStats();
		$currentSeason->setAttribute('goals', $currentSeasonStats[0]['goals'] == "" ? "0" : $currentSeasonStats[0]['goals']);
		$currentSeason->setAttribute('matches', $currentSeasonStats[0]['matches'] == "" ? "0" : $currentSeasonStats[0]['matches']);

		// Tournament Stats
		foreach ($tournamentStatsData->result() as $row):
			$tournamentLabel = $dom->createCDATASection($row->label . " " . $row->season);
			$tournament = $dom->createElement("tournament");
			$tournament->setAttribute('goals', $row->goals);
			$tournament->setAttribute('matches', $row->matches);
			$tournament->setAttribute('color', $colors[$index]);
			$tournament->setAttribute('champion', $row->champion);
			$label = $dom->createElement("label");
			$label->appendChild($tournamentLabel);
			$tournament->appendChild($label);
			$tournaments->appendChild($tournament);
			$index++;
			if ($index == sizeof($colors)) $index = 0;
		endforeach;

		$stats->appendChild($general);
		$stats->appendChild($currentSeason);
		$stats->appendChild($tournaments);
		$data->appendChild($stats);
		$dom->appendChild($data);
		header("Content-Type: text/xml");
		print $dom->saveXML();
		
	}

}