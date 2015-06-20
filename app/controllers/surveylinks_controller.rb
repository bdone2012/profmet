
class SurveylinksController < ApplicationController
  def index

  end

def new
    @surveylink = Surveylink.new
  end

  def create
    @surveylink = Surveylink.new(surveylink_params)
    if @surveylink.save
      redirect_to("/")
    else
      render :new
    end
  end

  def update
    # @point =
  end

  def surveylink_params
    params.require(:surveylink).permit(
      :link,
      :survey_code
    )
  end

end
