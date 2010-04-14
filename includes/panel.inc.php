<div id="ta_form">
	<input type="text" id="ta_search" name="ta_search" />
	<a href="" id="ta_search_button" class="button-primary">Search &raquo;</a>
	<ul id="ta_options">
		<li><strong>View:</strong></li>
		<li>
			<label for="nounsCheck">
				<input type="checkbox" id="nounsCheck" name="nounsCheck" <?php echo $nounsChecked; ?> /> Nouns
			</label>
		</li>
		<li>
			<label for="verbsCheck">
				<input type="checkbox" id="verbsCheck" name="verbsCheck" <?php echo $verbsChecked; ?> /> Verbs
			</label>
		</li>
		<li>
			<label for="adjCheck">
				<input type="checkbox" id="adjCheck" name="adjCheck" <?php echo $adjsChecked; ?> /> Adjectives
			</label>
		</li>
	</ul>
</div>
<div id="ta_results">
	<div class="ta_inner">
	
	</div>
	<ul id="ta_links">
		<li><a href="" id="ta_clear">Clear results</a></li>
		<li class="last"><a href="<?php echo $optionurl; ?>" id="ta_options">View options</a></li>
		<li class="bhlLink">Thesaurus service provided by: <a href="http://words.bighugelabs.com/">words.bighugelabs.com</a></li>
	</ul>
</div>
<div id="ta_loading"></div>