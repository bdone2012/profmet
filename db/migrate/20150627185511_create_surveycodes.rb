class CreateSurveycodes < ActiveRecord::Migration
  def change
    create_table :surveycodes do |t|
       t.string :surveycode
       t.string :surveylink_id
      t.timestamps
    end
  end
end
