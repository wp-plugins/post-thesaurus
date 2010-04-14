<div class='wrap' id="thesaurusContainer">
	<div id="icon-options-general" class="icon32">&nbsp;</div>
	<h2>Post Thesaurus v1.0.0.0</h2>
	<?php echo $update_fade; ?>

	<div class="thesaurus-container">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<div class="postbox" id="taSettings">
						<div title="Click to toggle" class="handlediv"><br></div>
						<h3 class="hndle">
							<span>Post Thesaurus Settings</span>
						</h3>
						<div class="inside">
							<ul id="ta_promotion">
								<li><a href="http://nooshu.com/">Author website</a></li>
								<li><a href="http://nooshu.com/wordpress-plug-in-post-thesaurus/">Plug-in page</a></li>
								<li class="last">Thesaurus service provided by <a href="http://words.bighugelabs.com/">words.bighugelabs.com</a></li>
							</ul>
							
							<ul>
								<li><strong>Type of words checked by default:</strong></li>
								<li>
									<label for="nouns">
										<input id="nouns" name="nouns" type="checkbox" <?php echo $nounsChecked; ?> /> Nouns
									</label>
								</li>
								<li>
									<label for="verbs">
										<input id="verbs" name="verbs" type="checkbox" <?php echo $verbsChecked; ?> /> Verbs
									</label>
								</li>
								<li>
									<label for="adjectives">
										<input id="adjectives" name="adjectives" type="checkbox" <?php echo $adjsChecked; ?> /> Adjectives
									</label>
								</li>
						    </ul>
						    <ul>
								<li>
									<strong>Big Huge Thesaurus API Key</strong> <small>(optional)</small>
								</li>
								<li>
									<p>Unfortunately using the Big Huge Labs API isn't 100% free. Each API key gets 10,000 requests per day, so if lots of people start to use this plug-in it may be necessary to create your own API key (<strong>don't worry, it's free</strong>). You can <a href="http://words.bighugelabs.com/login.php?returnurl=/getkey.php">create an account here</a>. Then just fill in the form to request your own API key.</p>
									<p>For the 'Describe your application in 25 words or more' section, you could try something like this:</p>
									<blockquote>
									Hey BigHugeLabs, love your Thesaurus API. I'm planning on using my API key for the Wordpress Plug-in 'Post Thesaurus' by Matt Hobbs (http://nooshu.com/). I hope that's okay! Keep up the great work!
									</blockquote>
								</li>
								<li>
									<label for="bhtKey">API Key: </label>
									<input id="bhtKey" name="bhtKey" value="<?php echo $customAPIKey; ?>" />
								</li>
							</ul>
						    <input class='button-primary' type="submit" name="ta_settings" value="Save Settings &raquo;" />

						    <ul id="ta_uninstall">
						    	<li>
						    		<strong>Uninstall Plug-in</strong>
						    	</li>
						    	<li>
						    		<p>This button simply removes the options from the database written by the plug-in.</p>
						    	</li>
						    	<li>
						    		<input class='button-secondary' type="submit" name="ta_uninstall" value="Uninstall &raquo;" />
						    	</li>
						    </ul>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div><!-- postbox-container -->
</div><!-- div class='wrap' id="thesaurusContainer" -->