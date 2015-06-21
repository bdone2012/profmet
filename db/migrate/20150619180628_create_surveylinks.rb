class CreateSurveylinks < ActiveRecord::Migration
  def change
    create_table :surveylinks do |t|
      t.string :link
      t.string :time_estimate
      t.string :instructions
      t.string :amount_participants

      t.timestamps
    end
  end
end
