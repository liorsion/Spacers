class AddSpeedKnowledgeToParticipation < ActiveRecord::Migration
  def change
  	change_table(:participations) do |t|
  		t.integer :speed
  		t.integer :knowledge
  	end
  end
end
