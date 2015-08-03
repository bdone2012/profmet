class CreateGetsurveys < ActiveRecord::Migration
  def change
    create_table :getsurveys do |t|

      t.timestamps
    end
  end
end
