/** 
 * @projectDescription	Thesaurus JS
 * @author 	Matt Hobbs (http://nooshu.com/)
 * @version 	0.1 
 */
jQuery(function($){
	//Check if we need to run the code
	if($("#ta_search").length){
		//Generate returned HTML
		var generate = function(relData, headerText, containerID){
			var generatedHTML = "<div class='ta_container' id=" + containerID + "><p class='ta_main'>" + headerText + "</p>";
			
			$.each(relData, function(i, set){
				switch(i){
					case "syn":
						generatedHTML += "<p class='ta_type'>Synonyms</p>";
						break;
					case "ant":
						generatedHTML += "<p class='ta_type'>Antonyms</p>";
						break;
					case "rel":
						generatedHTML += "<p class='ta_type'>Related</p>";
						break;
					case "sim":
						generatedHTML += "<p class='ta_type'>Similar</p>";
						break;
					case "usr":
						generatedHTML += "<p class='ta_type'>User Suggested</p>";
						break;
				}
				
				//Loop through each word in set array
				generatedHTML += "<ul class='" + i + "'>";
				$.each(set, function(i, word){
					if(i === (set.length-1)){
						generatedHTML += "<li>" + word + "</li>";
					} else {
						generatedHTML += "<li>" + word + ",</li>";
					}
				});
				generatedHTML += "</ul>";
			});
			generatedHTML += "</div>";
			return generatedHTML;
		};
		
		$("#ta_search_button").click(function(){
			var $this = $(this);
			var $results = $("#ta_results");
			var $inner = $results.find(".ta_inner");
			var $loading = $("#ta_loading");
			var val = $("#ta_search").val();
			var apiKey;
			
			if(typeof window.customAPI === "undefined"){
				apiKey = "f8c97ab61253376f68a9af401f5353a7";
			} else {
				apiKey = window.customAPI;
			}
			
			var url = "http://words.bighugelabs.com/api/2/" + apiKey + "/" + val + "/json";
			$loading.show();
			$.ajax({
				url: url,
				dataType: "jsonp",
				type: 'GET',
				error: function(error){
					$inner.empty();
					var errorHTML = "<p>Oops there has been an error: '" + error + "' was returned.</p>";
					$inner.append(errorHTML);
					$inner.show();
				},
				success: function(data){
					$inner.empty();
					if('noun' in data){
						var resultN = generate(data.noun, "Nouns", "ta_n");
						$inner.append(resultN);
					}
					if ('verb' in data) {
						var resultV = generate(data.verb, "Verbs", "ta_v");
						$inner.append(resultV);
					}
					if('adjective' in data){
						var resultA = generate(data.adjective, "Adjectives", "ta_a");
						$inner.append(resultA);
					}
					
					//Show / Hide section depending on whats checked
					if(!$("#nounsCheck").is(":checked") && $inner.find("#ta_n").length){
						$inner.find("#ta_n").hide();
					}
					if(!$("#verbsCheck").is(":checked") && $inner.find("#ta_v").length){
						$inner.find("#ta_v").hide();
					}
					if(!$("#adjCheck").is(":checked") && $inner.find("#ta_a").length){
						$inner.find("#ta_a").hide();
					}
					
					$loading.hide();
					$results.show();
				}
			});
			return false;
		});
		
		//Clear the results
		$("#ta_clear").click(function(){
			$("#ta_results").find(".ta_inner").empty().end().hide();
			return false;
		});
		
		//Show & hide sections
		$("#ta_options").find("input[type='checkbox']").click(function(e){
			var $this = $(this);
			if($(".ta_container", document.getElementById('ta_results')).length){
				var changed = $this.attr("id");
				var container;
				switch(changed){
					case "nounsCheck":
						container = "ta_n";
						break;
					case "verbsCheck":
						container = "ta_v";
						break;
					case "adjCheck":
						container = "ta_a";
						break;
				}
				if($this.is(":checked")){
					$("#"+container, document.getElementById('ta_results')).show();
				} else {
					$("#"+container, document.getElementById('ta_results')).hide();
				}
			}
		});
	}
});