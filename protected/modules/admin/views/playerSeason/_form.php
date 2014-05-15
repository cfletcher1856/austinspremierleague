<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'player-season-form',
		'enableAjaxValidation'=>false,
	));
?>
	<input type="hidden" name="PlayerSeason[season_id]" value="<?php echo $season->id; ?>" />
	<input type="hidden" name="PlayerSeason[player_json]" value="" id="player_json" />
	<table class="table">
	<thead>
		<tr>
			<th>Player</th>
			<th>Division</th>
			<th><button class="btn btn-primary btn-mini" type="button" name="yt1" data-bind="click: addPlayer"><i class="icon-plus"></i> Add Player</button></th>
		</tr>
	</thead>
	<tbody data-bind="foreach: players">
		<tr>
			<td>
				<select data-bind="optionsCaption: '--Player--', options: $parent.activePlayers, optionsText: 'name', optionsValue: 'player_id', value: player"></select>
			</td>
			<td>
				<select data-bind="optionsCaption: '--Division--', options: $parent.activeDivisions, optionsText: 'name', optionsValue: 'division_id', value: division"></select>
			</td>
			<td>
				<a href="#" class="btn btn-mini btn-danger" data-bind="visible: $parent.players().length > 1, click: $parent.removePlayer">&times;</a>
			</td>
		</tr>
	</tbody>
	</table>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Update',
			'htmlOptions' => array(
				'id'=>'submit_form'
			)
		)); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
	$(function(){
		var active_players = <?php echo json_encode($activePlayers); ?>;
		var active_divisions = <?php echo json_encode($activeDivisions); ?>;
		current_players = <?php echo json_encode($currentPlayers); ?>;

		Player = function(player_id, division_id){
			var self = this;

			self.player = ko.observable(player_id);
			self.division = ko.observable(division_id);
		}

		viewModel = function(){
			var self = this;

			self.activePlayers = ko.observableArray(active_players);
			self.activeDivisions = ko.observableArray(active_divisions);
			self.players = ko.observableArray();
			self.addPlayer = function(){
				self.players.push(new Player());
				$("select").chosen();
			}
			self.removePlayer = function(){
				self.players.remove(this);
			}
		}

		view_model = new viewModel();

		for(i in current_players){
			var player_id, division_id;
			player_id = current_players[i]['player'];
			division_id = current_players[i]['division'];

			view_model.players.push(new Player(player_id, division_id));
		}

		ko.applyBindings(view_model);

		$("#submit_form").on('click', function(evt){
			evt.preventDefault();
			json_data = ko.toJSON(view_model, null, 2);
			parsed_data = JSON.parse(json_data);

			delete parsed_data.activePlayers;
			delete parsed_data.activeDivisions;

			$("#player_json").val(ko.toJSON(parsed_data, null, 2));
			$("#player-season-form").submit();
		});
	});
</script>
