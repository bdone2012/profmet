class Surveylink < ActiveRecord::Base
  belongs_to :user
  has_many :surveycodes

before_validation :smart_add_url_protocol

protected

def smart_add_url_protocol
  unless self.link[/\Ahttp:\/\//] || self.link[/\Ahttps:\/\//]
    self.link = "http://#{self.link}"
  end
end

end
