<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AspirantesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $campos;
    protected $query;

    public function __construct(array $campos, Builder $query)
    {
        $this->campos = $campos;
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get($this->campos);
    }

    public function map($aspirante): array
    {
        $datos = [];
        foreach ($this->campos as $campo) {
            if ($campo === 'carrera_principal_id') {
                $datos[] = optional($aspirante->carreraPrincipal)->nombre ?? '-';
            } else {
                $datos[] = $aspirante->$campo ?? '-';
            }
        }
        return $datos;
    }

    public function headings(): array
    {
        $titulos = [];
        foreach ($this->campos as $campo) {
            $titulos[] = ucwords(str_replace('_', ' ', $campo));
        }
        return $titulos;
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $sheet->getHighestRow();
        $columnCount = $sheet->getHighestColumn();

        // 🔹 Encabezados con fondo azul y texto blanco
        $sheet->getStyle('A1:' . $columnCount . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1D4ED8'] // azul institucional
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center'
            ]
        ]);

        // 🔹 Bordes finos para todas las celdas con datos
        $sheet->getStyle('A1:' . $columnCount . $rowCount)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '999999']
                ]
            ]
        ]);

        // 🔹 Altura y ajuste de texto
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getStyle('A1:' . $columnCount . $rowCount)->getAlignment()->setWrapText(true);

        return [];
    }
}
