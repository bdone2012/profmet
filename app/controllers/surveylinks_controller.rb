
class SurveylinksController < ApplicationController
  def index

  end

def new
    @surveylink = Surveylink.new
  end


  def create
    @surveylink = Surveylink.new(surveylink_params)


    if @surveylink.save
      # Publish post data
      Publisher.publish("surveylinks", @surveylink.attributes)
       redirect_to @surveylink, notice: 'Surveylink was successfully created.'
    else
      render :new
    end
end

  def update
    # @point =
  end

  def show
  #   require "bunny"
  #   conn = Bunny.new
  #   conn.start

  #   ch = conn.create_channel

  #   # get or create queue (note the durable setting)
  #   queue = ch.queue("dashboard.surveylinks", durable: true)

  # delivery_info, properties, payload = queue.pop

  # conn.close

  end

  def surveylink_params
    params.require(:surveylink).permit(
      :link,
      :time_estimate,
      :instruction,
      :participant,
      :started,
      :completed
    )
  end

end
