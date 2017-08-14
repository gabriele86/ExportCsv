<?php

namespace GB\ExportCsv;

class Export {

    protected $handle = null;
    protected $delimiter;
    protected $enclosure;
    protected $escape;

    function __construct(){

        $this->delimiter = config('csv.delimiter');
        $this->enclosure = config('csv.enclosure');
        $this->escape = config('csv.escape');

    }


    function exportCsv($data, $fileName = '') {

		

		// Flatten each row of the data array
		$flatData = array();
		foreach($data as $numericKey => $row){
			$flatRow = array();
			$this->flattenArray($row, $flatRow);
			$flatData[$numericKey] = $flatRow;
		}

		$headerRow = $this->getKeysForHeaderRow($flatData);
		$flatData = $this->mapAllRowsToHeaderRow($headerRow, $flatData);



		if(empty($fileName)){
			$fileName = "export_".date("Y-m-d").".csv";
		}

		$csvFile = fopen('php://output', 'w');
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');

		fputcsv($csvFile,$headerRow, $this->delimiter, $this->enclosure);
		foreach ($flatData as $key => $value) {
			fputcsv($csvFile, $value, $this->delimiter, $this->enclosure);
		}
		fclose($csvFile);
	
		exit;
	}

	private function flattenArray($array, &$flatArray, $parentKeys = ''){
		foreach($array as $key => $value){
			$chainedKey = ($parentKeys !== '')? $parentKeys.'.'.$key : $key;
			if(is_array($value)){
				$this->flattenArray($value, $flatArray, $chainedKey);
			} else {
				$flatArray[$chainedKey] = $value;
			}
		}
	}

	private function getKeysForHeaderRow($data){
		$headerRow = array();
		foreach($data as $key => $value){
			foreach($value as $fieldName => $fieldValue){
				if(array_search($fieldName, $headerRow) === false){
					$headerRow[] = $fieldName;
				}
			}
		}

		return $headerRow;
	}

	private function mapAllRowsToHeaderRow($headerRow, $data){
		$newData = array();
		foreach($data as $intKey => $rowArray){
			foreach($headerRow as $headerKey => $columnName){
				if(!isset($rowArray[$columnName])){
					//$rowArray[$columnName] = '';
					$newData[$intKey][$columnName] = '';
				} else {
					$newData[$intKey][$columnName] = $rowArray[$columnName];
				}
			}
		}

		return $newData;
	}


}