<?php /* Smarty version 2.6.26, created on 2022-07-06 19:14:39
         compiled from shop.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shop.tpl', 20, false),array('modifier', 'nl2br', 'shop.tpl', 59, false),array('modifier', 'date_format', 'shop.tpl', 90, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @headerPath, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="main">

    <div class="btnGroup toolbar_bottom_action visible">
        <?php if ($this->_tpl_vars['shopData']['tel']): ?>
                <a href="tel:<?php echo $this->_tpl_vars['shopData']['tel']; ?>
" class="detailBtn horizontal">
                    <i class="fa fa-mobile" aria-hidden="true"></i> 電話する
                </a>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['shopData']['mail']): ?>
                <a href="mailto:<?php echo $this->_tpl_vars['shopData']['mail']; ?>
?subject=『<?php echo @siteNamePrint; ?>
』から問い合わせ" class="keepBtn">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>メールを送る
                </a>
        <?php endif; ?>
    </div>


    <div id="detailTitle" class="clearfix page-title-bar">
        <h1><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['shopName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h1>
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
                    <h2 class="jobUpdate"> <?php echo $this->_tpl_vars['shopData']['areaName']; ?>
 <span><?php echo $this->_tpl_vars['shopData']['prefectureName']; ?>
</span></h2>
                    <div class="iconGroup clearfix">
                        <?php $_from = $this->_tpl_vars['iconArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['result']['iteration']++;
?>
                            <span class="icon_workPR_<?php if ($this->_tpl_vars['shopData']['icon'][$this->_tpl_vars['key']]['iconList']): ?>strong<?php else: ?>term<?php endif; ?>"><?php echo $this->_tpl_vars['value']; ?>
</span>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <?php if ($this->_tpl_vars['shopData']['imgIdGal']): ?>
                        <div id="include" class="shopImg-position">
                            <div id="spPrm">
                                <a href="http://<?php echo $this->_tpl_vars['shopData']['URL']; ?>
" target="_blank">
                                    <img src="./inc/picR.php?imgId=<?php echo $this->_tpl_vars['shopData']['imgIdGal']; ?>
&amp;t=image" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['shopName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="shopImg" />
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['shopData']['workComment']): ?>
                        <section class="contBg" id="knowMore">
                            <h2><i class="fa-solid fa-check fontawesome"></i>基本情報</h2>
                            <div>
                                <div class="knowMoreText"><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['license'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['shopComment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</h3>

                </div><!-- /jobHeader -->

                <?php if ($this->_tpl_vars['shopData']['URL']): ?>
                <div id="func_btn_box" class="func_btn_box">
                    <div class="func_btns horizontal_btn_box">
                        <a href="http://<?php echo $this->_tpl_vars['shopData']['URL']; ?>
" class="history full"  target="_blank">
                            <i class="fa fa-home" aria-hidden="true"></i> HPを見る
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['news']): ?>
                <div class="slidePoint">
                    <section id="appealPoint" class="contBg">
                        <h2 id="btnCheck03">新着情報</h2>
                    </section>

                    <div class="jobDetailList">
                        <ul id="btnCheck01" class="jobDetailCont jobList fortable">
                            <?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
                            <li>
                                <h3><?php echo $this->_tpl_vars['row']['title']; ?>
</h3>
                                <p class="detail noExpand">
                                    <small><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['dateTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %H:%M")); ?>
 更新</small><br />
                                    <?php if ($this->_tpl_vars['row']['filePath']): ?><img src="<?php echo $this->_tpl_vars['row']['filePath']; ?>
&amp;mw=320&amp;mh=240" alt="<?php echo $this->_tpl_vars['row']['title']; ?>
" /><?php endif; ?>
                                    <?php if ($this->_tpl_vars['row']['file']): ?><img src="./userImg/whatsNew/<?php echo $this->_tpl_vars['row']['imgId']; ?>
/w320.jpg" alt="<?php echo $this->_tpl_vars['row']['title']; ?>
" /><?php endif; ?>
                                    <br /><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['comment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

                                </p>
                            </li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>


                    </div>
                </div>
                <?php endif; ?>
            </section><!-- /jobDetail -->
        </div><!-- /tab-1 -->

        <div id="tab-2" class="tab-content">
            <?php if ($this->_tpl_vars['shopData']['workComment']): ?>
            <section class="contBg" id="knowMore">
                <h2>メニュー</h2>
                <div>
                    <div class="knowMoreText"><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['workComment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
                </div>
            </section>
            <?php endif; ?>
        </div><!-- /tab-2 -->

        <div id="tab-3" class="tab-content">
            <section class="contBg" id="application">
                <h2>募集要項</h2>
                <div>
                    <ul class="jobDetailCont jobList">
                        <li>
                            <h3>職種</h3>
                            <p><?php echo $this->_tpl_vars['shopData']['genreName']; ?>
</p>
                        </li>
                        <?php if ($this->_tpl_vars['shopData']['jobCategory']): ?><li><h3>募集職種</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['jobCategory'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['jobBack']): ?><li><h3>募集背景</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['jobBack'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['employ']): ?><li><h3>雇用形態</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['employ'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['place']): ?><li><h3>勤務地</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['place'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['traffic']): ?><li><h3>交通</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['traffic'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['workTime']): ?><li><h3>勤務時間</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['workTime'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['salary']): ?><li><h3>年収・給与</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['salary'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['treatment']): ?><li><h3>待遇・福利厚生</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['treatment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['holiday']): ?><li><h3>休日休暇</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['holiday'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['educatetrain']): ?><li><h3>教育制度</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['educatetrain'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['establish']): ?><li><h3>設立</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['establish'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['represent']): ?><li><h3>代表者</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['represent'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['companyMoney']): ?><li><h3>資本金</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['companyMoney'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['employee']): ?><li><h3>従業員数</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['employee'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['business']): ?><li><h3>事業内容</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['business'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['officePlace']): ?><li><h3>事業所</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['officePlace'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['selection']): ?><li><h3>選考プロセス</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['selection'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['application']): ?><li><h3>応募方法</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['application'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['interviewPlace']): ?><li><h3>面接地</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['interviewPlace'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['shopData']['contactAddress']): ?><li><h3>連絡先</h3><p><?php echo ((is_array($_tmp=$this->_tpl_vars['shopData']['contactAddress'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p></li><?php endif; ?>
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


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => @footerPath, 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>