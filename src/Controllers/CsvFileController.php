<?php

namespace Vitab\TaskManagementSystem\Controllers;

use mysqli;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Vitab\TaskManagementSystem\Services\DatabaseService;

class CsvFileController
{
    public function exportCsv(): void
    {
        $spreadsheet = new Spreadsheet();
        $writer = new Csv($spreadsheet);

        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1', 'Title');
        $activeSheet->setCellValue('B1', 'Employees');
        $activeSheet->setCellValue('C1', 'Created At');
        $activeSheet->setCellValue('D1', 'Completed At');

        $database = new DatabaseService();

        $db = new mysqli(
            "localhost:$database->databaseLocalhost",
            $database->databaseUsername,
            $database->databasePassword,
            'management_system'
        );

        $query = $db->query("
        SELECT a.id, a.title, a.status, GROUP_CONCAT( e.firstname, ' ', e.lastname) as name, 
        a.created_at, a.updated_at 
        FROM assignments a
        JOIN employees_assignments ea ON ea.assignment_id=a.id
        JOIN employees e ON ea.employee_id=e.id
        WHERE a.status='complete'
        GROUP BY a.title, a.updated_at
        ORDER BY a.updated_at DESC
        ");

        if ($query->num_rows > 0) {
            $i = 2;
            while ($row = $query->fetch_assoc()) {
                $activeSheet->setCellValue('A' . $i, $row['title']);
                $activeSheet->setCellValue('B' . $i, $row['name']);
                $activeSheet->setCellValue('C' . $i, $row['created_at']);
                $activeSheet->setCellValue('D' . $i, $row['updated_at']);
                $i++;
            }
        }

        $filename = 'archive.csv';

        header('Content-Type: application/text-csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $writer->save('php://output');
    }
}
