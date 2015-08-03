
class SurveylinksController < ApplicationController
  def index

  end

def new
    @surveylink = Surveylink.new
  end


  def create
    @surveylink = Surveylink.new(surveylink_params)

    if @surveylink.save
       redirect_to @surveylink, notice: 'Surveylink was successfully created.'
    else
      render :new
    end
end

  def update
    @surveylink = Surveylink.where("completed > started").first
  end

  def show

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
