<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name=”format-detection” content=”no” />
    <meta property="og:url" content="https://mtmbds.com/">
    <meta property="og:title" content="엠티엠비즈 디자인">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://mtmbds.com/resources/users/img/site_logo.jpg">
    <meta property="og:description" content="MTM Biz Design은 복합 콘텐츠 운영을 통해 고객 맞춤형 통합 디자인 서비스를 제공하는 디자인 전문기업입니다.">
    <meta name="title" content="엠티엠비즈 디자인">
    <meta name="Subject" content="고객 맞춤형 디자인 전문기업">
    <meta name="keywords" content="CI/BI,명함,봉투,사원증,현판,리플렛,전단,브로셔,포스터,스티커,책자,실사출력,배너,현수막,상세페이지,웹배너,비즈니스문서,이미지편집,월간디자인,패키지상품,웹디자인가이드">
    <meta name="Descript-xion" content="MTM Biz Design은 복합 콘텐츠 운영을 통해 고객 맞춤형 통합 디자인 서비스를 제공하는 디자인 전문기업입니다.">
    <meta name="Description" content="차별화된 경쟁력과 체계적인 전략 및 기술력을 바탕으로 고객과의 소통을 최우선 가치로 삼고 오프라인 제작물과 온라인 디자인에 이르기까지 다양한 영역에 걸쳐 고객이 원하는 목표를 달성할 수 있도록 통합 디자인 서비스를 제공하는 고객맞춤형 디자인 전문기업입니다.">

    <link rel="icon" href="/resources/users/favicon/favicon.ico">
    <link rel="stylesheet" href="/resources/users/css/styles.css?<?= time() ?>">
    
    <?php
        // URL에서 경로만 추출하고 파일 이름을 얻습니다.
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $current_page = basename($url_path, ".php");

        // 공통 스타일시트 로드
        if (strpos($url_path, 'business/list') !== false) {
            echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/detail.css">';
            echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/common.css">';
        }

        // 페이지 이름에 따라 스타일시트를 로드합니다.
        switch ($current_page) {
            case 'consulting':
                echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/consulting.css">';
                break;
            case 'business':
                echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/business.css">';
                break;
            case 'company':
                echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/company.css">';
                break;
            case 'customer':
                echo '<link rel="stylesheet" type="text/css" href="/resources/users/css/subpage/customer.css">';
                break;
            default:
                // 기본 스타일시트를 로드하거나 아무 것도 하지 않습니다.
            break;
        }
?>

    <!-- Biz Spring Logger -->
    <script type="text/javascript">
        (function(b, s, t, c, k) {
            b[k] = s;
            b[s] = b[s] || function() {
                (b[s].q = b[s].q || []).push(arguments)
            };
            var f = t.getElementsByTagName(c)[0],
                j = t.createElement(c);
            j.async = true;
            j.src = '//fs.bizspring.net/gp/gp.v.1.0.yeji.js';
            f.parentNode.insertBefore(j, f);
        })(window, '_gp', document, 'script', 'BSGPObj');
        _gp('111348', 'land');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NYYKGTHJPB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NYYKGTHJPB');
    </script>

    <title>엠티엠비즈 디자인</title>
</head>