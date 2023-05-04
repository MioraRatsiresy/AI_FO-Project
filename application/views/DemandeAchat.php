
	<!--<a href="http://localhost/VenteAchat/DemandeAchatController/updateProduit?idproduit=14&&designation=Souris&&code=huhu">Add</a>-->
	<h2>Demande d'achat</h2>
	<b>Departement <?php echo $_SESSION['libelle']; ?></b>
	<br>
	<span>Rubrique</span>
	<select id="rubrique" data-placeholder="Choisissez une rubrique..." class="chosen-select" tabindex="4" style="width:200px;"
	 onchange="getDesignationByRubrique();" required>
		<option value=""></option>
		<?php foreach($rubrique as $rubrique) { ?>
		<option value="<?php echo $rubrique['idrubrique']; ?>">
			<?php echo $rubrique['genre']; ?>
		</option>
		<?php } ?>
	</select>
	<span>Designation</span>
	<select id="designation" data-placeholder="Choisissez une designation..." class="chosen-select" tabindex="4" style="width:200px;"
	 onchange="getQualiteByDesignation();" required>
		<option value=""></option>
	</select>
	<button data-toggle="modal" data-target="#modalDesignation" id="ajoutDesignation">...</button>
	<span>Qualite</span>
	<select id="qualite" data-placeholder="Choisissez une qualite..." class="chosen-select" tabindex="4" style="width:200px;">
		<option value=""></option>
	</select>
	<span>Quantite</span>
	<input type="number" name="quantite" id="quantite" min="1">
	<button type="button" class="btn btn-info" onclick="add();">OK</button>
	<div id="listeDemandeTemporaire"></div>

	<div class="modal fade" id="modalDesignation" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ajouter une nouvelle designation</h4>
					<button type="button" class="close" data-dismiss="modal" style="float:left;">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<span>Rubrique : </span>
						<select id="rubriqueModal" data-placeholder="Choisissez une rubrique..." class="chosen-select" tabindex="4" id="rubrique"
						 style="width:200px;" required>
							<option value=""></option>
							<?php foreach($rubrique1 as $rubrique) { ?>
							<option value="<?php echo $rubrique['idrubrique']; ?>">
								<?php echo $rubrique['genre']; ?>
							</option>
							<?php } ?>
						</select>
						<button onclick="ajouterRubrique();" class="btn btn-primary">Ajouter</button>
						<input type="hidden" name="" id="newRubrique">
						<button id="validateNewRubrique" disabled onclick="saveNewRubrique(); " class="btn btn-success">OK</button>
						<br>
						<br>
						<span>Code du produit : </span>
						<input class="form-control" id="code" name="code" type="text" value="" placeholder="ex: STL (code pour indiquer 'stylo')">
						<br>
						<span>Designation : </span>
						<input class="form-control" id="nouvelleDesignation" name="search" type="text" value="" placeholder="">
						<br>
						<span>Qualite</span>
						<select id="qualiteModal" data-placeholder="Choisissez une rubrique..." class="chosen-select" tabindex="4" multiple style="width:200px;"
						 required>
							<option value=""></option>
							<?php foreach($qualite as $qualite) { ?>
							<option value="<?php echo $qualite['idqualite']; ?>">
								<?php echo $qualite['type']; ?>
							</option>
							<?php } ?>
						</select>
						<button onclick="ajouterQualite();" class="btn btn-primary">Ajouter</button>
						<input type="hidden" name="" id="newQualite">
						<button id="validateNewQualite" disabled onclick="saveNewQualite();" class="btn btn-success">OK</button>
					</div>
					<div id="resultat"></div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-danger">Annuler</button>
						<button type="button" onclick="saveNewDesignation();" class="btn btn-primary">OK</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script>
		$('#modalRubrique').appendTo("body");
		$('#modalDesignation').appendTo("body");
		$('#modal').appendTo("body");
		//document.getElementById('ajoutDesignation').disabled=true;
		//document.getElementById('designation').disabled=true;
		$("#rubriqueModal").chosen({
			width: "inherit"
		});
		$("#qualiteModal").chosen({
			width: "inherit"
		});
		$("#rubriqueSearch").chosen({
			width: "inherit"
		});
	</script>
	<script>
		function getDesignationByRubrique() {
			var idRubrique = document.getElementById("rubrique").value;
			console.log("Id rubrique : " + idRubrique);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/getDesignationByRubrique/" +
				idRubrique;
			console.log("Url : " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var selectDesignation = document.getElementById('designation');
						console.log("Length : " + selectDesignation);
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#designation').prepend(new Option(retour[item]['codeproduit'] + "-" + retour[item]['designation'], retour[
								item]['idproduit']));
							$('#designation').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function getQualiteByDesignation() {
			var idDesignation = document.getElementById("designation").value;
			console.log("Id rubrique : " + idDesignation);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/getQualiteByDesignation/" +
				idDesignation;
			console.log("Url : " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var selectDesignation = document.getElementById('qualite');
						console.log("Length : " + selectDesignation);
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#qualite').prepend(new Option(retour[item]['qualite'], retour[item]['idqualite']));
							$('#qualite').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}
		$('#designation').prepend(new Option('Designation', designation));
		$(".chosen-select").chosen();
		$('#qualite').prepend(new Option('Qualite', designation));
		$(".chosen-select").chosen();

		function add() {
			console.log("Ajout de demande");
			let rubrique = document.getElementById("rubrique").value;
			let designation = document.getElementById("designation").value;
			let qualite = document.getElementById("qualite").value;
			let quantite = document.getElementById("quantite").value;
			console.log("Rubrique: " + rubrique);
			console.log("Designation: " + designation);
			console.log("Qualite: " + qualite);
			console.log("Quantite: " + quantite);
			let tab = quantite + "-" + designation + "-" + qualite;
			console.log("A envoyer : " + tab);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/insertDemandeTemporaire/" +
				tab;
			console.log(url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						document.getElementById("listeDemandeTemporaire").innerHTML = this.responseText;
						//alert("OK");
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function save() {
			console.log("Enregistrement de la demande");
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/saveDemande";
			console.log(url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						alert("Enregistrement effectue avec succes");
						document.getElementById("listeDemandeTemporaire").innerHTML = "";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function deleteLigneDemande(id) {
			console.log("Supprimer une ligne de demande");
			console.log("Id demande: " + id);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/deleteLigneDemande/" +
				id;
			console.log(url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						document.getElementById("listeDemandeTemporaire").innerHTML = this.responseText;
						alert("Suppression effectue avec succes");
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function modifier(qtt, idDemande) {
			document.getElementById("quantiteModifier").value = qtt;
			console.log(document.getElementById("quantiteModifier").value);
		}

		function showModalModifier(qtt) {
			console.log(qtt);
			//$('#modalModifier').show();
			//$('#modalModifier').appendTo("body");
		}

		function ajouterRubrique() {
			document.getElementById('newRubrique').type = 'text';
			document.getElementById('validateNewRubrique').disabled = false;
		}

		function saveNewRubrique() {
			console.log("Save new rubrique");
			var newValue = document.getElementById('newRubrique').value;
			console.log("New rubrique : " + newValue);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/newRubrique/" +
				newValue;
			console.log(url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var selectDesignation = document.getElementById('rubriqueModal');
						var selectDesignation1 = document.getElementById('rubrique');
						console.log("Length : " + selectDesignation);
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						var option1 = selectDesignation1.querySelectorAll('option');
						option1.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueModal').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubriqueModal').trigger("chosen:updated");
							$('#rubrique').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubrique').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById('newRubrique').type = 'hidden';
						document.getElementById('validateNewRubrique').disabled = true;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function ajouterQualite() {
			document.getElementById('newQualite').type = 'text';
			document.getElementById('validateNewQualite').disabled = false;
		}

		function saveNewQualite() {
			console.log("Save new qualite");
			var newValue = document.getElementById('newQualite').value;
			console.log("New rubrique : " + newValue);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/newQualite/" +
				newValue;
			console.log(url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var selectDesignation = document.getElementById('qualiteModal');
						console.log("Length : " + selectDesignation);
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#qualiteModal').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
							$('#qualiteModal').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById('newQualite').type = 'hidden';
						document.getElementById('validateNewQualite').disabled = true;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function saveNewDesignation() {
			console.log("Save new designation: ");
			var qualites = $('#qualiteModal').chosen().val();
			var qualiteDesignation = qualites.toString();
			var rubrique = document.getElementById('rubriqueModal').value;
			var designation = document.getElementById('nouvelleDesignation').value;
			var code = document.getElementById('code').value;
			console.log("Rubrique: " + rubrique);
			console.log("Qualites: " + qualiteDesignation);
			console.log("Code" + code);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/newDesignation?rubrique=" +
				rubrique + "&&qualites=" + qualiteDesignation + "&&designation=" + designation + "&&code=" + code;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						//alert("OK");
						//var retour1=JSON.stringify(xhr.responseText);
						var retour = JSON.parse('[' + xhr.responseText + ']');
						var selectDesignation = document.getElementById('designation');
						console.log("Length : " + selectDesignation);
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#designation').prepend(new Option(retour[item]['codeproduit'] + "-" + retour[item]['designation'], retour[
								item]['idproduit']));
							$('#designation').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						$('#modalDesignation').modal('hide');
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function fillSelectOption() {
			console.log("Fill select option selon le choix de la categorie");
			var categorie = document.getElementById('categorie').value;
			console.log("Categorie : " + categorie);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/fillSelectOption?categorie=" +
				categorie;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						console.log("Taille : " + retour.length);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							console.log("Efa ato");
							if (categorie === "rubrique") {
								console.log(retour[item]['genre']);
								$('#rubriqueSearch').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
								$('#rubriqueSearch').trigger("chosen:updated");
							}
							if (categorie === "produit") {
								console.log(retour[item]['designation']);
								$('#rubriqueSearch').prepend(new Option(retour[item]['designation'], retour[item]['idproduit']));
								$('#rubriqueSearch').trigger("chosen:updated");
							}
							if (categorie === "qualite") {
								console.log(retour[item]['type']);
								$('#rubriqueSearch').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
								$('#rubriqueSearch').trigger("chosen:updated");
							}
						}
						$(".chosen-select").chosen();
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function rechercher() {
			console.log("Rechercher : ");
			var categorie = document.getElementById('categorie').value;
			var search = document.getElementById('rubriqueSearch').value;
			console.log("Categorie : " + categorie);
			console.log("Mot a rechercher : " + search);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/rechercher?categorie=" +
				categorie + "&&search=" + search;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						//alert("OK");
						document.getElementById("resultat-search").innerHTML = this.responseText;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function update(idQualite) {
			console.log("Update qualite");
			console.log("Id qualite : " + idQualite);
			console.log("New value : " + document.getElementById("qualiteToEdit").value);
			var qualite = document.getElementById("qualiteToEdit").value;
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/updateQualite?idqualite=" +
				idQualite + "&&qualite=" + qualite;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('qualiteModal');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueSearch').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
							$('#rubriqueSearch').trigger("chosen:updated");
							$('#qualiteModal').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
							$('#qualiteModal').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML =
							"<div class='alert alert-success alert-dismissible fade show' role='alert'>Qualit&eacute; mis &agrave; jour avec succes!!!╰(*°▽°*)╯<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function deleteQualite(idQualite) {
			console.log("Delete qualite");
			console.log("Id qualite : " + idQualite);
			var url = "<?php echo base_url(); ?>DemandeAchatController/deleteQualite/" +
				idQualite;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('qualiteModal');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueSearch').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
							$('#rubriqueSearch').trigger("chosen:updated");
							$('#qualiteModal').prepend(new Option(retour[item]['type'], retour[item]['idqualite']));
							$('#qualiteModal').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML =
							"<div class='alert alert-danger alert-dismissible fade show' role='alert'>Suppression effectuee avec succes!!!╰(*°▽°*)╯<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function updateRubrique(idRubrique) {
			console.log("Update rubrique");
			console.log("Id rubrique : " + idRubrique);
			console.log("New value : " + document.getElementById("rubriqueToEdit").value);
			var rubrique = document.getElementById("rubriqueToEdit").value;
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/updateRubrique?idrubrique=" +
				idRubrique + "&&rubrique=" + rubrique;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('rubriqueModal');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('rubrique');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueSearch').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubriqueSearch').trigger("chosen:updated");
							$('#rubriqueModal').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubriqueModal').trigger("chosen:updated");
							$('#rubrique').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubrique').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML =
							"<div class='alert alert-success alert-dismissible fade show' role='alert'>Rubrique mis &agrave; jour avec succes!!!╰(*°▽°*)╯<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function deleteRubrique(idRubrique) {
			console.log("Delete rubrique");
			console.log("Id rubrique : " + idRubrique);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/deleteRubrique/" +
				idRubrique;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('rubriqueModal');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						var selectDesignation = document.getElementById('rubrique');
						var option = selectDesignation.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueSearch').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubriqueSearch').trigger("chosen:updated");
							$('#rubriqueModal').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubriqueModal').trigger("chosen:updated");
							$('#rubrique').prepend(new Option(retour[item]['genre'], retour[item]['idrubrique']));
							$('#rubrique').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML =
							"<div class='alert alert-danger alert-dismissible fade show' role='alert'>Rubrique effacee avec succes!!!╰(*°▽°*)╯<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function deleteProduitQualite(idQualite, idProduit) {
			console.log("Delete produit qualite");
			console.log("Id qualite : " + idQualite + " and id produit=" + idProduit);
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/deleteProduitQualite?idQualite=" +
				idQualite + "&&idProduit=" + idProduit;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML = this.responseText;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}

		function updateProduit(idProduit) {
			console.log("Update produit");
			console.log("Id produit : " + idProduit);
			//console.log("New value : " + document.getElementById("rubriqueToEdit").value);
			var designation = document.getElementById("designationToEdit").value;
			var code = document.getElementById("codeToEdit").value;
			var url =
				"<?php echo base_url(); ?>DemandeAchatController/updateProduit?idproduit=" +
				idProduit + "&&designation=" + designation + "&&code="
			code;
			console.log("Url: " + url);
			var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = JSON.parse(xhr.responseText);
						var select = document.getElementById('rubriqueSearch');
						var option = select.querySelectorAll('option');
						option.forEach(o => o.remove());
						for (var item in retour) {
							$('#rubriqueSearch').prepend(new Option(retour[item]['designation'], retour[item]['idproduit']));
							$('#rubriqueSearch').trigger("chosen:updated");
						}
						$(".chosen-select").chosen();
						document.getElementById("resultat-search").innerHTML = "";
						document.getElementById("resultat-search").innerHTML =
							"<div class='alert alert-success alert-dismissible fade show' role='alert'>Produit mis &agrave; jour avec succes!!!╰(*°▽°*)╯<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			//XMLHttpRequest.open(method, url, async)
			xhr.open("GET", url, false);
			//XMLHttpRequest.send(body)
			xhr.send(null);
		}
	</script>
