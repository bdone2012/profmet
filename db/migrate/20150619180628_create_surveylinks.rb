class CreateSurveylinks < ActiveRecord::Migration
  def change
    create_table :surveylinks do |t|
      t.string :link
      t.string :code

      t.timestamps
    end
  end
end
