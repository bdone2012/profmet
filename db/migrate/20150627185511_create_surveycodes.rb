class CreateSurveycodes < ActiveRecord::Migration
  def change
    create_table :surveycodes do |t|
      t.string :surveycode
      t.timestamps
    end
  end
end
