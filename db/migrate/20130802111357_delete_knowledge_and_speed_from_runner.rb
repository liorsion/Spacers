class DeleteKnowledgeAndSpeedFromRunner < ActiveRecord::Migration
  def change
  	remove_column :runners, :speed
  	remove_column :runners, :knowledge
  end
end
