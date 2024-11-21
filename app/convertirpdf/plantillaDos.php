<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../static/img/LogoPrincipal.png', 30, 30, 30);

        // Fuente para el título
        $this->SetFont('Arial', 'B', 18);

        // Título principal
        $this->SetTextColor(33, 37, 41); // Color gris oscuro
        $this->Cell(0, 10, 'Reporte de Empleados', 0, 1, 'C');
        $this->Ln(5); // Espaciado entre título y subtítulo

        // Subtítulo
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(100, 100, 100); // Gris claro
        $this->Cell(0, 10, 'Listado generado automaticamente', 0, 1, 'C');
        
        // Línea divisoria
        $this->SetDrawColor(200, 200, 200); // Gris claro
        $this->SetLineWidth(0.5);
        $this->Line(10, 40, 205, 40); // Línea horizontal
        $this->Ln(10); // Espaciado después de la línea
    }

    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);

        // Fuente para el pie de página
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150); // Gris medio

        // Línea divisoria superior
        $this->SetDrawColor(220, 220, 220); // Gris claro
        $this->SetLineWidth(0.3);
        $this->Line(10, $this->GetY() - 5, 205, $this->GetY() - 5); // Línea horizontal superior

        // Texto del pie de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
?>
