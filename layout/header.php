<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title><?php echo $setup['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= $setup['description']; ?>" name="description" />
    <meta content="<?= $setup['name-admin']; ?>" name="author" />
    
    <meta content="<?= $setup['keywords']; ?>" name="keywords" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $setup['icon']; ?>">
    <!-- App css -->
    <link href="../assets/auth/css/bootstrap.min.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../assets/auth/css/icons.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../assets/auth/css/metisMenu.min.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    <link href="../assets/auth/css/style.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="../assets/auth/plugins/sweet-alert2/sweetalert2.min.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css">
    <link href="../assets/auth/plugins/animate/animate.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js?ver=<?= time(); ?>"></script>
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js?ver=<?= time(); ?>"></script>
    <link href="../assets/libs/sweetalert2/sweetalert2.min.css?ver=<?= time(); ?>" rel="stylesheet" type="text/css" />
    <script src="../assets/js/nam.js?ver=<?= time(); ?>"></script>
    <!-- Thả Tim -->
    <script type='text/javascript'>
        ! function(e, t, a) {
            function n() {
                c(".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"), o(), r()
            }

            function r() {
                for (var e = 0; e < d.length; e++) d[e].alpha <= 0 ? (t.body.removeChild(d[e].el), d.splice(e, 1)) : (d[e].y--, d[e].scale += .004, d[e].alpha -= .013, d[e].el.style.cssText = "left:" + d[e].x + "px;top:" + d[e].y + "px;opacity:" + d[e].alpha + ";transform:scale(" + d[e].scale + "," + d[e].scale + ") rotate(45deg);background:" + d[e].color + ";z-index:99999");
                requestAnimationFrame(r)
            }

            function o() {
                var t = "function" == typeof e.onclick && e.onclick;
                e.onclick = function(e) {
                    t && t(), i(e)
                }
            }

            function i(e) {
                var a = t.createElement("div");
                a.className = "heart", d.push({
                    el: a,
                    x: e.clientX - 5,
                    y: e.clientY - 5,
                    scale: 1,
                    alpha: 1,
                    color: s()
                }), t.body.appendChild(a)
            }

            function c(e) {
                var a = t.createElement("style");
                a.type = "text/css";
                try {
                    a.appendChild(t.createTextNode(e))
                } catch (t) {
                    a.styleSheet.cssText = e
                }
                t.getElementsByTagName("head")[0].appendChild(a)
            }

            function s() {
                return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
            }
            var d = [];
            e.requestAnimationFrame = function() {
                return e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || e.msRequestAnimationFrame || function(e) {
                    setTimeout(e, 1e3 / 60)
                }
            }(), n()
        }(window, document);
    </script>
    <style>
        .account-body.accountbg {
            background-image: url("../assets/auth/background.png");
            background-size: cover;
            background-position: center center;
            width: 100%;
            height: 100vh;
        }
    </style>
</head>