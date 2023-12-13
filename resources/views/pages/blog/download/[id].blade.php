<?php
    use Barryvdh\DomPDF\Facade\Pdf;

    $base_url           = env('APP_URL');
    $view_data          = file_get_contents($base_url."/blog/$id");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($view_data)->setPaper('a4', 'landscape')->save('pickle-pdf.pdf');

?>

<script>
    window.location = "/pickle-pdf.pdf";
</script>