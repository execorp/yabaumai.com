{include file=$smarty.const.headerPath}

<div class="main">

    <div class="btnGroup toolbar_bottom_action visible">
        {if $shopData.tel}
                <a href="tel:{$shopData.tel}" class="detailBtn horizontal">
                    <i class="fa fa-mobile" aria-hidden="true"></i> 電話する
                </a>
        {/if}
        {if $shopData.mail}
                <a href="mailto:{$shopData.mail}?subject=『{$smarty.const.siteNamePrint}』から問い合わせ" class="keepBtn">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>メールを送る
                </a>
        {/if}
    </div>


    <div id="detailTitle" class="clearfix page-title-bar">
        <h1>{$shopData.shopName|escape:'html'}</h1>
    </div>

    <div id="kyujindata">
        <ul class="tabs-menu three">
            <li class="current">
                <a href="#tab-1" data-tab="tab-1">概要</a>
            </li>
            <li class="">
                <a href="#tab-2" data-tab="tab-2">メニュー</a>
            </li>
            <li>
                <a href="#tab-3" data-tab="tab-3">求人情報</a>
            </li>
        </ul>

        <div id="tab-1" class="tab-content current">
            <!-- jobDetail セクション -->
            <section id="jobDetail">
                <div class="jobHeader">
                    <h2 class="jobUpdate"> {$shopData.areaName} <span>{$shopData.prefectureName}</span></h2>
                    <div class="iconGroup clearfix">
                        {foreach from=$iconArray item=value name=result key=key}
                            <span class="icon_workPR_{if $shopData.icon.$key.iconList}strong{else}term{/if}">{$value}</span>
                        {/foreach}
                    </div>
                    {if $shopData.imgIdGal}
                        <div id="include" class="shopImg-position">
                            <div id="spPrm">
                                <a href="http://{$shopData.URL}" target="_blank">
                                    <img src="./inc/picR.php?imgId={$shopData.imgIdGal}&amp;t=image" alt="{$shopData.shopName|escape:'html'}" class="shopImg" />
                                </a>
                            </div>
                        </div>
                    {/if}
                    {if $shopData.workComment}
                        <section class="contBg" id="knowMore">
                            <h2><i class="fa-solid fa-check fontawesome"></i>基本情報</h2>
                            <div>
                                <div class="knowMoreText">{$shopData.license|nl2br}</div>
                            </div>
                        </section>
                    {/if}

                    <h3>{$shopData.shopComment|nl2br}</h3>

                </div><!-- /jobHeader -->

                {if $shopData.URL}
                <div id="func_btn_box" class="func_btn_box">
                    <div class="func_btns horizontal_btn_box">
                        <a href="http://{$shopData.URL}" class="history full"  target="_blank">
                            <i class="fa fa-home" aria-hidden="true"></i> HPを見る
                        </a>
                    </div>
                </div>
                {/if}

                {if $news}
                <div class="slidePoint">
                    <section id="appealPoint" class="contBg">
                        <h2 id="btnCheck03">新着情報</h2>
                    </section>

                    <div class="jobDetailList">
                        <ul id="btnCheck01" class="jobDetailCont jobList fortable">
                            {foreach from=$news key=key item=row}
                            <li>
                                <h3>{$row.title}</h3>
                                <p class="detail noExpand">
                                    <small>{$row.dateTime|date_format:"%Y/%m/%d %H:%M"} 更新</small><br />
                                    {if $row.filePath}<img src="{$row.filePath}&amp;mw=320&amp;mh=240" alt="{$row.title}" />{/if}
                                    {if $row.file}<img src="./userImg/whatsNew/{$row.imgId}/w320.jpg" alt="{$row.title}" />{/if}
                                    <br />{$row.comment|nl2br}
                                </p>
                            </li>
                            {/foreach}
                        </ul>


                    </div>
                </div>
                {/if}
            </section><!-- /jobDetail -->
        </div><!-- /tab-1 -->

        <div id="tab-2" class="tab-content">
            {if $shopData.workComment}
            <section class="contBg" id="knowMore">
                <h2><i class="fa-solid fa-bars fontawesome"></i>メニュー</h2>
                <div>
                    <div class="knowMoreText">{$shopData.workComment|nl2br}</div>
                </div>
            </section>
            {/if}
{*            {if $shopData.activityaction}*}
{*                <section class="contBg" id="knowMore">*}
{*                    <h2>こんな人が活躍（向いています） </h2>*}
{*                    <div>*}
{*                        <div class="knowMoreText">{$shopData.activityaction|nl2br}</div>*}
{*                    </div>*}
{*                </section>*}
{*            {/if}*}
        </div><!-- /tab-2 -->

        <div id="tab-3" class="tab-content">
            <section class="contBg" id="application">
                <h2><i class="fa-solid fa-file-pen fontawesome"></i>募集要項</h2>
                <div>
                    <ul class="jobDetailCont jobList">
                        <li>
                            <h3>職種</h3>
                            <p>{$shopData.genreName}</p>
                        </li>
                        {if $shopData.jobCategory}<li><h3>募集職種</h3><p>{$shopData.jobCategory|nl2br}</p></li>{/if}
                        {if $shopData.jobBack}<li><h3>募集背景</h3><p>{$shopData.jobBack|nl2br}</p></li>{/if}
                        {if $shopData.employ}<li><h3>雇用形態</h3><p>{$shopData.employ|nl2br}</p></li>{/if}
                        {if $shopData.place}<li><h3>勤務地</h3><p>{$shopData.place|nl2br}</p></li>{/if}
                        {if $shopData.traffic}<li><h3>交通</h3><p>{$shopData.traffic|nl2br}</p></li>{/if}
                        {if $shopData.workTime}<li><h3>勤務時間</h3><p>{$shopData.workTime|nl2br}</p></li>{/if}
                        {if $shopData.salary}<li><h3>年収・給与</h3><p>{$shopData.salary|nl2br}</p></li>{/if}
                        {if $shopData.treatment}<li><h3>待遇・福利厚生</h3><p>{$shopData.treatment|nl2br}</p></li>{/if}
                        {if $shopData.holiday}<li><h3>休日休暇</h3><p>{$shopData.holiday|nl2br}</p></li>{/if}
                        {if $shopData.educatetrain}<li><h3>教育制度</h3><p>{$shopData.educatetrain|nl2br}</p></li>{/if}
                        {if $shopData.establish}<li><h3>設立</h3><p>{$shopData.establish|nl2br}</p></li>{/if}
                        {if $shopData.represent}<li><h3>代表者</h3><p>{$shopData.represent|nl2br}</p></li>{/if}
                        {if $shopData.companyMoney}<li><h3>資本金</h3><p>{$shopData.companyMoney|nl2br}</p></li>{/if}
                        {if $shopData.employee}<li><h3>従業員数</h3><p>{$shopData.employee|nl2br}</p></li>{/if}
                        {if $shopData.business}<li><h3>事業内容</h3><p>{$shopData.business|nl2br}</p></li>{/if}
                        {if $shopData.officePlace}<li><h3>事業所</h3><p>{$shopData.officePlace|nl2br}</p></li>{/if}
                        {if $shopData.selection}<li><h3>選考プロセス</h3><p>{$shopData.selection|nl2br}</p></li>{/if}
                        {if $shopData.application}<li><h3>応募方法</h3><p>{$shopData.application|nl2br}</p></li>{/if}
                        {if $shopData.interviewPlace}<li><h3>面接地</h3><p>{$shopData.interviewPlace|nl2br}</p></li>{/if}
                        {if $shopData.contactAddress}<li><h3>連絡先</h3><p>{$shopData.contactAddress|nl2br}</p></li>{/if}
                    </ul>
                </div>
            </section>
        </div><!-- /tab-3 -->

        <ul class="tabs-menu bottom three">
            <li class="current">
                <a href="#tab-1" data-tab="tab-1">概要</a>
            </li>
            <li class="">
                <a href="#tab-2" data-tab="tab-2">メニュー</a>
            </li>
            <li>
                <a href="#tab-3" data-tab="tab-3">求人情報</a>
            </li>
        </ul>

    </div><!-- /kyujindata -->

    <div class="back-to-top"><span>TOPへ</span></div>

</div>


{include file=$smarty.const.footerPath}