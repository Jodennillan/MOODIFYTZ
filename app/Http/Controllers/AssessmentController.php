<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function create()
    {
        return view('assessment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'emotional_state.mood' => [
                'required', 
                'string', 
                Rule::in(['Calm', 'Anxious', 'Overwhelmed', 'Fatigued'])
            ],
            'stress_factors' => 'required|array|min:1',
            'stress_factors.*' => 'string|in:Work pressure,Relationships,Financial worries,Health concerns,Loneliness,Uncertainty',
            'anxiety_level' => 'required|integer|between:1,5',
            'coping_mechanisms' => 'required|array|min:1',
            'coping_mechanisms.*' => 'string|in:Exercise,Meditation,Social support,Creative outlets,Professional help,Nature',
            'sleep_quality' => 'required|string|in:Restful,Interrupted,Insufficient,Restless',
            'wellness_goal' => 'required|string',
            'positive_action' => 'required|string|max:500'
        ]);

        try {
            $advice = $this->generateAdvice($validated);
        } catch (\Exception $e) {
            // Fallback if advice generation fails
            $advice = ["We encountered an issue generating personalized advice. Our team is working on it. In the meantime, consider reaching out to a mental health professional for support."];
        }
        
        $assessment = Assessment::create([
            'user_id' => Auth::id(),
            'answers' => $validated,
            'advice' => $advice
        ]);

        return redirect()->route('assessment.results', $assessment);
    }

    public function show(Assessment $assessment)
    {
        return view('assessment.results', compact('assessment'));
    }

    private function generateAdvice($data)
    {
        $advice = [];
        
        // Mood-based advice
        $mood = $data['emotional_state']['mood'];
        $moodAdvice = [
            'Calm' => "It's wonderful that you're feeling calm. Consider maintaining this state with mindfulness exercises.",
            'Anxious' => "For feelings of anxiety, try the 4-7-8 breathing technique: Inhale 4s, hold 7s, exhale 8s.",
            'Overwhelmed' => "When feeling overwhelmed, break tasks into smaller steps and prioritize what's essential.",
            'Fatigued' => "For fatigue, ensure you're staying hydrated and consider gentle movement like stretching."
        ];
        $advice[] = $moodAdvice[$mood];
        
        // Anxiety level advice
        $anxietyLevel = (int)$data['anxiety_level'];
        if ($anxietyLevel >= 4) {
            $advice[] = "Your anxiety level is elevated. Grounding techniques can help: Name 5 things you see, 4 you feel, 3 you hear, 2 you smell, 1 you taste.";
        } elseif ($anxietyLevel >= 3) {
            $advice[] = "With moderate anxiety, progressive muscle relaxation can be effective. Tense and release each muscle group.";
        }
        
        // Stress factors advice
        if (in_array('Work pressure', $data['stress_factors'])) {
            $advice[] = "For work stress, try the Pomodoro technique: 25 minutes focused work, 5 minutes break.";
        }
        if (in_array('Relationships', $data['stress_factors'])) {
            $advice[] = "For relationship stress, practice 'I feel' statements to communicate needs without blame.";
        }
        if (in_array('Financial worries', $data['stress_factors'])) {
            $advice[] = "Financial worries respond well to concrete planning. Dedicate 30 minutes weekly to review finances.";
        }
        if (in_array('Health concerns', $data['stress_factors'])) {
            $advice[] = "For health concerns, focus on what you can control: regular check-ups, healthy habits, and seeking support.";
        }
        if (in_array('Loneliness', $data['stress_factors'])) {
            $advice[] = "Combat loneliness by joining groups or communities with shared interests, even online ones.";
        }
        if (in_array('Uncertainty', $data['stress_factors'])) {
            $advice[] = "For uncertainty, practice acceptance and focus on the present moment through mindfulness.";
        }
        
        // Coping mechanisms enhancement
        $copingMap = [
            'Exercise' => "Aim for 30 minutes of moderate exercise daily for optimal stress relief.",
            'Meditation' => "Try guided meditations for stress reduction. Even 5 minutes daily makes a difference.",
            'Social support' => "Schedule regular connection time with supportive friends or family.",
            'Creative outlets' => "Engage in creative activities for at least 15 minutes daily to express emotions.",
            'Professional help' => "Consider scheduling regular sessions with a therapist for ongoing support.",
            'Nature' => "Spend at least 20 minutes in nature daily to reduce cortisol levels."
        ];
        
        foreach ($data['coping_mechanisms'] as $method) {
            if (isset($copingMap[$method])) {
                $advice[] = $copingMap[$method];
            }
        }
        
        // Sleep quality advice
        $sleepAdvice = [
            'Restful' => "Great sleep patterns! Maintain consistency with your sleep schedule.",
            'Interrupted' => "For interrupted sleep, limit liquids 2 hours before bed and keep a sleep journal.",
            'Insufficient' => "Prioritize 7-9 hours of sleep. Create a relaxing pre-sleep routine.",
            'Restless' => "For restless sleep, try magnesium supplements or a weighted blanket."
        ];
        $advice[] = $sleepAdvice[$data['sleep_quality']];
        
        // Wellness goal advice
        $goal = $data['wellness_goal'];
        $goalAdvice = [
            'Reduce stress' => "For stress reduction, practice daily diaphragmatic breathing.",
            'Improve mood' => "To boost mood, engage in activities that create 'flow' state daily.",
            'Better sleep' => "For better sleep, create a cool, dark sleeping environment.",
            'Increase focus' => "To improve focus, try the 'time blocking' technique for tasks.",
            'Build resilience' => "Build resilience by practicing cognitive reframing of challenges.",
            'Enhance relationships' => "For better relationships, practice active listening techniques."
        ];
        
        if (isset($goalAdvice[$goal])) {
            $advice[] = $goalAdvice[$goal];
        } else {
            $advice[] = "Your goal '$goal' is important. Break it into small actionable steps.";
        }
        
        // Positive action reinforcement
        $advice[] = "Your planned positive action ('{$data['positive_action']}') is excellent! Schedule it today.";
        
        return array_unique($advice);
    }

    public function download(Assessment $assessment)
{
    $pdf = Pdf::loadView('assessment.pdf', compact('assessment'));
    return $pdf->download('mindfulwell-action-plan-'.$assessment->id.'.pdf');
}
}