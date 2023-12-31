<h1 ng-non-bindable><?php echo htmlspecialchars($survey)?></h1>

<div role="tabpanel" ng-non-bindable>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="nav-item"><a class="nav-link <?php if ($tab == 'list' || $tab == '') : ?>active<?php endif;?>" href="<?php echo $append_filter?>?tab=list" ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('survey/collected','List')?></a></li>
		<li role="presentation" class="nav-item"><a class="nav-link <?php if ($tab == 'chart') : ?>active<?php endif;?>" href="<?php echo $append_filter?>?tab=chart" ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('survey/collected','Chart')?></a></li>
	</ul>

    <!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane <?php if ($tab == 'list' || $tab == '') : ?>active<?php endif;?>" id="list">
		  <?php include(erLhcoreClassDesign::designtpl('lhsurvey/collected/search_panel.tpl.php')); ?>
          <?php include(erLhcoreClassDesign::designtpl('lhsurvey/forms/fields_names_enabled.tpl.php'));?>
		  <?php include(erLhcoreClassDesign::designtpl('lhsurvey/collected/list.tpl.php')); ?>
		</div>
		<div role="tabpanel" class="tab-pane <?php if ($tab == 'chart') : ?>active<?php endif;?>" id="chart">
            <?php if ($tab == 'chart') : ?>
		        <?php include(erLhcoreClassDesign::designtpl('lhsurvey/collected/chart.tpl.php')); ?>
            <?php endif; ?>
		</div>
	</div>
</div>