<?php
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DATOS DE LA RED: ', 0, 1, 'C');
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Contraseña: '.str_pad($contraseña, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Nombre del Equipo: '.str_pad($NEquipo, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'IP: '.str_pad($IP, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Mac: '.str_pad($Mac, STR_PAD_LEFT), 0, 1);
            
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DEPARTAMENTO: ', 0, 1, 'C');
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Departamento: '.str_pad($Departamento, STR_PAD_LEFT), 0, 1);

                            
                $pdf->AddPage();

                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'CODIGO DE BARRAS: ', 0, 1, 'C');
                
                $pdf->SetFont('dejavusans', '', 12, '', true);

                // Obtener las dimensiones del código de barras
                $barcodeWidth = 80;
                $barcodeHeight = 15;
                                    
                // Calcular la posición horizontal para centrar el código de barras
                $pageWidth = $pdf->GetPageWidth();
                $x = ($pageWidth - $barcodeWidth) / 2;
                                    
                $pdf->write1DBarcode($nuevo_id, 'C128', $x, '', $barcodeWidth, $barcodeHeight, 0.4, $style = array('position' => 'S', 'border' => 0, 'padding' => 0, 'fontsize' => 8, 'text' => true, 'stretchtext' => 0, 'align' => 'C'), 'N');
                                 