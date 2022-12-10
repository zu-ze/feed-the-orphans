<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="form">
    <script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
    <link href="/vendor/calendar/calendar.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/tailwind.output.css">
    <script async src="/vendor/calendar/calendar.js"></script>
     <style type="text/css">
        .active{
            background: rgba(255, 255, 255, 0.3);
            color: black !important;
        }
        .w3-table-all{border:1px solid #ccc}
        .w3-bordered tr,.w3-table-all tr{border-bottom:1px solid #ddd}
        .w3-striped tbody tr:nth-child(even){background-color:#f1f1f1}
        .w3-table-all tr:nth-child(odd){background-color:#fff}
        .w3-table-all tr:nth-child(even){background-color:#f1f1f1}
        .w3-hoverable tbody tr:hover,.w3-ul.w3-hoverable li:hover{background-color:#ccc}
        .w3-centered tr th,.w3-centered tr td{text-align:center}
        .w3-table td,.w3-table th,.w3-table-all td,.w3-table-all th{padding:6px 8px;display:table-cell;text-align:left;vertical-align:top}
        .w3-table th:first-child,.w3-table td:first-child,.w3-table-all th:first-child,.w3-table-all td:first-child{padding-left:16px}
        .w3-btn,.w3-btn-block{border:none;display:inline-block;outline:0;padding:8px 20px;vertical-align:middle;overflow:hidden;text-decoration:none !important;color:#fff;background-color:#000;text-align:center;cursor:pointer;white-space:nowrap}
        .btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
        .btn-sm{padding:.25rem .5rem;font-size:.875rem;line-height:1.5;border-radius:.2rem}
        .btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}
        .btn-danger{color:#fff;background-color:#dc3545;border-color:#dc3545}
    </style>
    <title>Document</title>
</head>
<body>
    <div id="overlay"></div>

    <div class="background"></div>
    <div>
        <?php include("../views/layout/adminnav.php") ?>
    </div>
    <div class="main">
        <div class="flex flex-row justify-center">
            <?php if(Application::$app->session->getFlash('success')):?>
                <div class="alert alert-success shadowed">
                    <p><?php echo Application::$app->session->getFlash('success'); ?></p>
                </div>
            <?php endif; ?>
            <?php if(Application::$app->session->getFlash('failed')):?>
                <div class="alert alert-failed shadowed">
                    <p><?php echo Application::$app->session->getFlash('failed'); ?></p>
                </div>
            <?php endif; ?>
        </div>
        {{content}}
    </div>
</body>
<script src="/js/main.js"></script>
</html>