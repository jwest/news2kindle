<html>
    <head>
        <title>Articles <?php echo date('Y.m.d') ?></title>
    </head>
    <body>

        <p>
            <a name="start" /></a>
            <h1 id="start">
                Articles <?php echo date('Y.m.d').' - ~'; ?>
            </h1>
        </p>

        <p>
            <a name="TOC" /></a>
            <h3 id="TOC">Table of Contents</h3>
        </p>
        <p>
            <?php foreach($toc as $websiteId => $website): ?>
                <p>
                    <a href="#chapwebsite<?php echo $websiteId; ?>">
                        <h2><?php echo $website->title ?></h2>
                    </a>
                </p>
    
                <?php foreach($website->articles as $articleId => $article): ?>
                    <p style="padding-left: 100px;">
                        <a href="#chap<?php echo $articleId ?>">
                            <h4><?php echo $article->title ?></h4>
                        </a>
                    </p>
                <?php endforeach; ?>

            <?php endforeach; ?>

        </p>

        <mbp:pagebreak />

        <?php foreach($toc as $websiteId => $website): ?>

            <div id="chapwebsite<?php echo $websiteId ?>"></div>
            <p><a name="chapwebsite<?php echo $websiteId ?>" /><h1><?php echo $website->title ?></h1></p>
            <h1 style="text-align: center;"> * * * </h1>
            <div style="margin-top: 100px;">Articles count: <b><?php echo count($website->articles) ?></b></div>
            <div style="margin-top: 5px;">Website url: <b><?php echo $website->url ?></b></div>

            <mbp:pagebreak />

            <?php foreach($website->articles as $articleId => $article): ?>
                
                <div style="background-color: #eee; padding:1px; margin: 1px;"><?php echo $website->title ?></div>
                <div id="chap<?php echo $articleId ?>"></div>
                <p><a name="chap<?php echo $articleId ?>" /><h4><?php echo $article->title ?></h4></p>
                <hr />
                <div><?php echo $article->content ?></div>
                <p><a href="<?php echo $article->url ?>"><?php echo $article->url ?></a></p>
                <mbp:pagebreak />

            <?php endforeach; ?>

        <?php endforeach; ?>

    </body>
</html>