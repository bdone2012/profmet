class CreateSurveylinks < ActiveRecord::Migration
  def change
    create_table :surveylinks do |t|
      t.string :link
      t.integer :time_estimate
      t.string :instruction
      t.integer :participant
      t.integer :started
      t.integer :completed

      t.timestamps
    end
  end
end
