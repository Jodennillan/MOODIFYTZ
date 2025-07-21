<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MindfulWell Action Plan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #16a34a; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 18px; font-weight: bold; color: #16a34a; margin-bottom: 10px; }
        .content { margin-left: 20px; }
        .recommendation { margin-bottom: 10px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🌿 MindfulWell</div>
        <h1>Personal Action Plan</h1>
        <p>Generated on: {{ now()->format('M d, Y') }}</p>
    </div>
    
    <div class="section">
        <div class="section-title">Assessment Summary</div>
        <div class="content">
            <p><strong>Date:</strong> {{ $assessment->created_at->format('M d, Y') }}</p>
            <p><strong>Mood:</strong> {{ $assessment->answers['emotional_state']['mood'] }}</p>
            <p><strong>Anxiety Level:</strong> {{ $assessment->answers['anxiety_level'] }}/5</p>
            <p><strong>Wellness Goal:</strong> {{ $assessment->answers['wellness_goal'] }}</p>
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">Personalized Recommendations</div>
        <div class="content">
            @foreach($assessment->advice as $tip)
                <div class="recommendation">✓ {{ $tip }}</div>
            @endforeach
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">Your Action Plan</div>
        <div class="content">
            <p>{{ $assessment->answers['positive_action'] }}</p>
            <p><strong>Commitment:</strong> Complete within 24 hours</p>
        </div>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} MindfulWell. All rights reserved.</p>
        <p>This document is personalized for {{ auth()->user()->name }}</p>
    </div>
</body>
</html>