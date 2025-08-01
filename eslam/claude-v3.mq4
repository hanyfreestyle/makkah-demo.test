//+------------------------------------------------------------------+
//|                                       Amro_magnetic(AwadKAB).mq4 |
//|                               Copyright © 2011, AwadKAB Software |
//|                                awadkab@hotmail.com               |
//+------------------------------------------------------------------+
#property copyright "Copyright © 2011, AwadKAB Software"
#property link      ""

#property indicator_chart_window

// إعدادات الوقت والتاريخ
extern string note="MT4 Time Setting";
extern int time_hour=0;
extern int start_week_day=1;
extern int start_week_hour=0;
extern int end_week_bar_missing=1;
extern int Nbars_of_day=1;

// إعدادات مجموعة الخطوط العلوية (H1-H5)
extern string note1="H1-H5 Setting";
extern color color1=Green;
extern int width1=2;
extern int style1=0;

// إعدادات مجموعة الخطوط السفلية من الهاي (H10-H14)
extern string note2="H10-H14 Setting";
extern color color2=LightGreen;
extern int width2=2;
extern int style2=0;

// إعدادات مجموعة الخطوط العلوية من اللو (L1-L5)
extern string note3="L1-L5 Setting";
extern color color3=Pink;
extern int width3=2;
extern int style3=0;

// إعدادات مجموعة الخطوط السفلية من اللو (L10-L14)
extern string note4="L10-L14 Setting";
extern color color4=Red;
extern int width4=2;
extern int style4=0;

// إعدادات لون المستطيل
extern string note5="Rectangle Color";
extern color Rec_color1=Gray;
extern color Rec_color2=PaleGoldenrod;

// إعدادات النصوص والتعليقات
extern string note6="Comment Setting";
extern int corner=0;
extern string note7="Column 1";
extern int xdis1=10;
extern int ydis1=10;
extern int font_size1=10;
extern string font_type1="Arial";
extern color font_color1=Lime;
extern string note8="Column 2";
extern int xdis2=70;
extern int ydis2=10;
extern int font_size2=10;
extern string font_type2="Arial";
extern color font_color2=Yellow;

// إعدادات ليبلات الأسعار
extern string note9="Price Label Setting";
extern bool show_price_Label=true;
extern int size=1;
extern int x_dis_LL=7;
extern int x_dis_HL=1;

extern bool Del_All_Objects=false;
static int day=0;

// متغيرات المستويات المحسوبة
struct MagneticLevels {
    double HL_Upper[5];   // HL1-HL5: مستويات المقاومة العلوية من الهاي
    double HL_Lower[5];   // HL10-HL14: مستويات الدعم السفلية من الهاي
    double LL_Upper[5];   // LL1-LL5: مستويات المقاومة العلوية من اللو
    double LL_Lower[5];   // LL10-LL14: مستويات الدعم السفلية من اللو
};

// أسماء المجموعات لسهولة الوصول
string HL_Upper_Names[5] = {"HL1", "HL2", "HL3", "HL4", "HL5"};
string HL_Lower_Names[5] = {"HL10", "HL11", "HL12", "HL13", "HL14"};
string LL_Upper_Names[5] = {"LL1", "LL2", "LL3", "LL4", "LL5"};
string LL_Lower_Names[5] = {"LL10", "LL11", "LL12", "LL13", "LL14"};

// خصائص كل مجموعة
struct GroupProperties {
    color line_color;
    int line_width;
    int line_style;
};

//+------------------------------------------------------------------+
//| دالة التهيئة                                                      |
//+------------------------------------------------------------------+
int init()
{
    return(0);
}

//+------------------------------------------------------------------+
//| دالة إنهاء المؤشر                                                 |
//+------------------------------------------------------------------+
int deinit()
{
    if(Del_All_Objects==true) DeleteAllObjects();
    return(0);
}

//+------------------------------------------------------------------+
//| الدالة الرئيسية للمؤشر                                            |
//+------------------------------------------------------------------+
int start()
{
    // التأكد من أن المؤشر يعمل على فريم H1 فقط
    if(Period()!=PERIOD_H1) return(0);

    static int valid;
    MagneticLevels levels;
    static double high, low;

    // حذف الكائنات عند تغيير اليوم
    if(TimeDay(Time[0])!=day)
    {
        DeleteAllObjects();
        day=TimeDay(Time[0]);
    }
    else return(0);

    // إعداد المتغيرات الأساسية
    int Nbars = Nbars_of_day * 26;
    double dig = 1, dd = 0;

    // المرور عبر البارات لحساب المستويات
    for(int i = Nbars; i >= 0; i--)
    {
        int barT1 = iBarShift(Symbol(), PERIOD_H1, Time[i], false);

        // التحقق من شروط البداية (ساعة محددة أو بداية الأسبوع)
        if(TimeHour(Time[barT1]) == time_hour ||
           (TimeDayOfWeek(Time[barT1]) == start_week_day && TimeHour(Time[barT1]) == start_week_hour))
        {
            // حساب عدد البارات حسب يوم الأسبوع
            if(TimeDayOfWeek(Time[i]) == start_week_day)
                dd = 24 - end_week_bar_missing;
            else
                dd = 24;

            // الحصول على أعلى وأقل سعر في الفترة المحددة
            high = NormalizeDouble(iHigh(Symbol(), 60, iHighest(Symbol(), 60, MODE_HIGH, dd, barT1+1)), Digits) / Point;
            low = NormalizeDouble(iLow(Symbol(), 60, iLowest(Symbol(), 60, MODE_LOW, dd, barT1+1)), Digits) / Point;

            // تعديل القيم حسب عدد الأرقام العشرية
            if(Digits == 2 || Digits == 4)
            {
                high = high * 10;
                low = low * 10;
                dig = 10;
            }

            // حساب المستويات المغناطيسية
            CalculateMagneticLevels(levels, high, low, dig);

            // رسم جميع المستويات
            DrawAllLevels(levels, i, barT1, dig);

            // رسم المنطقة المغناطيسية
            DrawMagneticArea(levels, i, dig);

            // عرض المعلومات والليبلات
            if(barT1 <= 23)
            {
                valid = barT1;
                DisplayLabelsAndInfo(levels, high, low, dig, barT1);

                // عرض ليبلات الأسعار إذا كانت مفعلة
                if(show_price_Label == true)
                {
                    DisplayPriceLabels(levels, i, dig);
                }
            }
        }
    }

    // عرض نطاق اليوم الحالي
    DisplayTodayRange(valid);

    return(0);
}

//+------------------------------------------------------------------+
//| حساب المستويات المغناطيسية بناءً على النسبة الذهبية              |
//+------------------------------------------------------------------+
void CalculateMagneticLevels(MagneticLevels &levels, double high, double low, double dig)
{
    // النسب الذهبية المستخدمة في الحسابات
    double gn1 = 1.618033989;  // النسبة الذهبية
    double gn2 = 0.618033989;  // النسبة الذهبية المعكوسة

    // حساب النطاق الأساسي
    double range = high - low;

    // حساب النطاق الذهبي
    double golden_range = (MathSqrt(range + (range * gn2))) * 10;

    // حساب النطاقات الخمسة
    double ranges[5];
    for(int j = 0; j < 5; j++)
    {
        ranges[j] = golden_range * (gn1 + j);
    }

    // حساب مستويات الهاي (HL)
    for(int j = 0; j < 5; j++)
    {
        levels.HL_Upper[j] = high + ranges[j];  // HL1-HL5: مستويات أعلى من الهاي
        levels.HL_Lower[j] = high - ranges[j];  // HL10-HL14: مستويات أقل من الهاي
    }

    // حساب مستويات اللو (LL)
    for(int j = 0; j < 5; j++)
    {
        levels.LL_Upper[j] = low + ranges[j];   // LL1-LL5: مستويات أعلى من اللو
        levels.LL_Lower[j] = low - ranges[j];   // LL10-LL14: مستويات أقل من اللو
    }
}

//+------------------------------------------------------------------+
//| رسم جميع المستويات على الشارت                                    |
//+------------------------------------------------------------------+
void DrawAllLevels(MagneticLevels &levels, int i, int barT1, double dig)
{
    // خصائص كل مجموعة
    GroupProperties groups[4];
    groups[0].line_color = color1; groups[0].line_width = width1; groups[0].line_style = style1; // HL1-HL5
    groups[1].line_color = color2; groups[1].line_width = width2; groups[1].line_style = style2; // HL10-HL14
    groups[2].line_color = color3; groups[2].line_width = width3; groups[2].line_style = style3; // LL1-LL5
    groups[3].line_color = color4; groups[3].line_width = width4; groups[3].line_style = style4; // LL10-LL14

    // رسم مستويات HL العلوية (HL1-HL5)
    for(int j = 0; j < 5; j++)
    {
        string description = "= " + DoubleToStr(NormalizeDouble(levels.HL_Upper[j] * Point / dig, Digits), Digits);
        DrawTrendLine(HL_Upper_Names[j] + " " + TimeToStr(Time[i], TIME_DATE),
                     barT1, NormalizeDouble(levels.HL_Upper[j] * Point / dig, Digits),
                     groups[0], i, description);
    }

    // رسم مستويات HL السفلية (HL10-HL14)
    for(int j = 0; j < 5; j++)
    {
        string description = "= " + DoubleToStr(NormalizeDouble(levels.HL_Lower[j] * Point / dig, Digits), Digits);
        if(j == 0) // إضافة معلومات المنطقة المغناطيسية للخط الأول
        {
            description += "\n Magnetic Area = " + DoubleToStr(levels.LL_Upper[0]/dig - levels.HL_Lower[0]/dig, 0) + " Pips";
        }
        DrawTrendLine(HL_Lower_Names[j] + " " + TimeToStr(Time[i], TIME_DATE),
                     barT1, NormalizeDouble(levels.HL_Lower[j] * Point / dig, Digits),
                     groups[1], i, description);
    }

    // رسم مستويات LL العلوية (LL1-LL5)
    for(int j = 0; j < 5; j++)
    {
        string description = "= " + DoubleToStr(NormalizeDouble(levels.LL_Upper[j] * Point / dig, Digits), Digits);
        if(j == 0) // إضافة معلومات المنطقة المغناطيسية للخط الأول
        {
            description += "\n Magnetic Area = " + DoubleToStr(levels.LL_Upper[0]/dig - levels.HL_Lower[0]/dig, 0) + " Pips";
        }
        DrawTrendLine(LL_Upper_Names[j] + " " + TimeToStr(Time[i], TIME_DATE),
                     barT1, NormalizeDouble(levels.LL_Upper[j] * Point / dig, Digits),
                     groups[2], i, description);
    }

    // رسم مستويات LL السفلية (LL10-LL14)
    for(int j = 0; j < 5; j++)
    {
        string description = "= " + DoubleToStr(NormalizeDouble(levels.LL_Lower[j] * Point / dig, Digits), Digits);
        DrawTrendLine(LL_Lower_Names[j] + " " + TimeToStr(Time[i], TIME_DATE),
                     barT1, NormalizeDouble(levels.LL_Lower[j] * Point / dig, Digits),
                     groups[3], i, description);
    }
}

//+------------------------------------------------------------------+
//| رسم خط اتجاه واحد مع خصائصه                                      |
//+------------------------------------------------------------------+
void DrawTrendLine(string name, int bar_index, double price, GroupProperties &props, int i, string description)
{
    datetime start_time, end_time;

    // حساب أوقات بداية ونهاية الخط
    CalculateLineTime(i, start_time, end_time);

    // إضافة مسافة للاسم في حالات خاصة
    if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
        name = name + " ";

    // إنشاء الخط
    ObjectCreate(name, OBJ_TREND, 0, 0, 0, 0, 0);
    ObjectSet(name, OBJPROP_PRICE1, price);
    ObjectSet(name, OBJPROP_TIME1, start_time);
    ObjectSet(name, OBJPROP_PRICE2, price);
    ObjectSet(name, OBJPROP_TIME2, end_time);

    // تحديد ما إذا كان الخط يمتد أم لا
    if(i > 23)
        ObjectSet(name, OBJPROP_RAY, false);
    else
        ObjectSet(name, OBJPROP_RAY, true);

    // تطبيق خصائص الخط
    ObjectSet(name, OBJPROP_COLOR, props.line_color);
    ObjectSet(name, OBJPROP_WIDTH, props.line_width);
    ObjectSet(name, OBJPROP_STYLE, props.line_style);
    ObjectSet(name, OBJPROP_BACK, true);

    // إضافة النص التوضيحي
    ObjectSetText(name, description, 10, "Times New Roman", Black);
}

//+------------------------------------------------------------------+
//| حساب أوقات بداية ونهاية الخط                                     |
//+------------------------------------------------------------------+
void CalculateLineTime(int i, datetime &start_time, datetime &end_time)
{
    // حساب وقت النهاية
    if(TimeDayOfWeek(Time[i]) != start_week_day)
    {
        if(time_hour != 0)
            end_time = StrToTime(TimeToStr(Time[i] + 60*60*24, TIME_DATE) + " " + (time_hour-1));
        else
            end_time = StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + "23:00");
    }
    else
    {
        if(time_hour != 0)
        {
            end_time = StrToTime(TimeToStr(Time[i] + 60*60*24, TIME_DATE) + " " + (time_hour-1));
        }
        if(time_hour != 0 && TimeHour(Time[i]) == 0 && start_week_hour == 0)
        {
            end_time = StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + (time_hour-1));
        }
        if(time_hour == 0)
            end_time = StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + "23:00");
    }

    // حساب وقت البداية
    if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
    {
        start_time = StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + 0);
    }
    else
    {
        start_time = StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + time_hour);
    }
}

//+------------------------------------------------------------------+
//| رسم المنطقة المغناطيسية (المستطيل)                               |
//+------------------------------------------------------------------+
void DrawMagneticArea(MagneticLevels &levels, int i, double dig)
{
    datetime start_time, end_time;
    CalculateLineTime(i, start_time, end_time);

    string name = "Magnetic Area" + " " + TimeToStr(Time[i], TIME_DATE);
    if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
        name = name + " ";

    double price1 = levels.HL_Lower[0] * Point / dig;  // HL10
    double price2 = levels.LL_Upper[0] * Point / dig;  // LL1

    ObjectCreate(name, OBJ_RECTANGLE, 0, 0, 0, 0, 0);
    ObjectSet(name, OBJPROP_PRICE1, price1);
    ObjectSet(name, OBJPROP_TIME1, start_time);
    ObjectSet(name, OBJPROP_PRICE2, price2);
    ObjectSet(name, OBJPROP_TIME2, end_time);

    // اختيار لون المستطيل حسب العلاقة بين المستويات
    if(levels.HL_Lower[0] < levels.LL_Upper[0])
    {
        ObjectSet(name, OBJPROP_COLOR, Rec_color1);
    }
    else
    {
        ObjectSet(name, OBJPROP_COLOR, Rec_color2);
    }

    ObjectSet(name, OBJPROP_WIDTH, 1);
    ObjectSet(name, OBJPROP_STYLE, 0);
}

//+------------------------------------------------------------------+
//| عرض الليبلات والمعلومات على الشارت                              |
//+------------------------------------------------------------------+
void DisplayLabelsAndInfo(MagneticLevels &levels, double high, double low, double dig, int barT1)
{
    // حساب النطاقات لعرضها
    double gn1 = 1.618033989;
    double gn2 = 0.618033989;
    double range = high - low;
    double golden_range = (MathSqrt(range + (range * gn2))) * 10;

    // عرض أسماء النطاقات (العمود الأول)
    CreateLabel("Range1", xdis1, ydis1, "Range 1", font_size1, font_type1, font_color1, corner);
    CreateLabel("Range2", xdis1, ydis1+20, "Range 2", font_size1, font_type1, font_color1, corner);
    CreateLabel("Range3", xdis1, ydis1+40, "Range 3", font_size1, font_type1, font_color1, corner);
    CreateLabel("Range4", xdis1, ydis1+60, "Range 4", font_size1, font_type1, font_color1, corner);
    CreateLabel("Range5", xdis1, ydis1+80, "Range 5", font_size1, font_type1, font_color1, corner);
    CreateLabel("Today_Range", xdis1, ydis1+100, "Today_Range", font_size1, font_type1, font_color1, corner);
    CreateLabel("Pre_day_Range", xdis1, ydis1+120, "Pre_day_Range", font_size1, font_type1, font_color1, corner);
    CreateLabel("===", xdis1, ydis1+140, "=======", font_size1, font_type1, font_color1, corner);
    CreateLabel("Pw_High", xdis1, ydis1+160, "Pw High", font_size1, font_type1, font_color1, corner);
    CreateLabel("Pw_Low", xdis1, ydis1+180, "Pw Low", font_size1, font_type1, font_color1, corner);
    CreateLabel("Pw_Open", xdis1, ydis1+200, "Pw Open", font_size1, font_type1, font_color1, corner);

    // عرض قيم النطاقات (العمود الثاني)
    for(int j = 0; j < 5; j++)
    {
        double range_value = golden_range * (gn1 + j);
        CreateLabel("Range" + (j+1) + "2", xdis2, ydis2 + (j*20), DoubleToStr(range_value/dig, 0),
                   font_size2, font_type2, font_color2, corner);
    }

    CreateLabel("Pre_day_Range_", xdis2+35, ydis2+120, DoubleToStr((high-low)/dig, 0),
               font_size2, font_type2, font_color2, corner);
    CreateLabel("Pw_Highh", xdis2, ydis2+160, DoubleToStr(trim(high), 0),
               font_size2, font_type2, font_color2, corner);
    CreateLabel("Pw_Loww", xdis2, ydis2+180, DoubleToStr(trim(low), 0),
               font_size2, font_type2, font_color2, corner);
    CreateLabel("Pw_Openn", xdis2, ydis2+200, DoubleToStr(trim(iOpen(Symbol(), PERIOD_H1, barT1)/Point), 0),
               font_size2, font_type2, font_color2, corner);
}

//+------------------------------------------------------------------+
//| إنشاء ليبل نصي                                                   |
//+------------------------------------------------------------------+
void CreateLabel(string name, int x_distance, int y_distance, string text,
                int font_size, string font_type, color text_color, int corner_pos)
{
    ObjectCreate(name, OBJ_LABEL, 0, 0, 0, 0);
    ObjectSet(name, OBJPROP_XDISTANCE, x_distance);
    ObjectSet(name, OBJPROP_YDISTANCE, y_distance);
    ObjectSetText(name, text, font_size, font_type, text_color);
    ObjectSet(name, OBJPROP_CORNER, corner_pos);
}

//+------------------------------------------------------------------+
//| عرض ليبلات الأسعار                                               |
//+------------------------------------------------------------------+
void DisplayPriceLabels(MagneticLevels &levels, int i, double dig)
{
    int addL, addH;

    // حساب الإزاحة الزمنية للليبلات
    if(time_hour > 0)
    {
        addL = 60*60*24 + x_dis_LL*60*60;
        addH = 60*60*24 + 60*60*x_dis_HL;
    }
    else
    {
        addL = 60*60*24 + 60*60*x_dis_LL;
        addH = 60*60*24 + 60*60*x_dis_HL;
    }

    // عرض ليبلات أسعار LL1-LL5
    for(int j = 0; j < 5; j++)
    {
        CreatePriceLabel("price_" + LL_Upper_Names[j],
                        NormalizeDouble(levels.LL_Upper[j] * Point / dig, Digits),
                        color3, size, (j == 0) ? 0 : 1, i, addL);
    }

    // عرض ليبلات أسعار LL10-LL14
    for(int j = 0; j < 5; j++)
    {
        CreatePriceLabel("price_" + LL_Lower_Names[j],
                        NormalizeDouble(levels.LL_Lower[j] * Point / dig, Digits),
                        color4, size, 1, i, addL);
    }

    // عرض ليبلات أسعار HL1-HL5
    for(int j = 0; j < 5; j++)
    {
        CreatePriceLabel("price_" + HL_Upper_Names[j],
                        NormalizeDouble(levels.HL_Upper[j] * Point / dig, Digits),
                        color1, size, 1, i, addH);
    }

    // عرض ليبلات أسعار HL10-HL14
    for(int j = 0; j < 5; j++)
    {
        CreatePriceLabel("price_" + HL_Lower_Names[j],
                        NormalizeDouble(levels.HL_Lower[j] * Point / dig, Digits),
                        color2, size, 1, i, addH);
    }
}

//+------------------------------------------------------------------+
//| إنشاء ليبل سعر                                                   |
//+------------------------------------------------------------------+
void CreatePriceLabel(string name, double price, color label_color, int width, int style, int i, int time_offset)
{
    ObjectCreate(name, OBJ_ARROW, 0, 0, 0);
    ObjectSet(name, OBJPROP_ARROWCODE, 6);
    ObjectSet(name, OBJPROP_TIME1, StrToTime(TimeToStr(iTime(NULL, PERIOD_H1, i) + time_offset, TIME_DATE|TIME_MINUTES)));
    ObjectSet(name, OBJPROP_PRICE1, price);
    ObjectSet(name, OBJPROP_COLOR, label_color);
    ObjectSet(name, OBJPROP_WIDTH, width);
    ObjectSet(name, OBJPROP_STYLE, style);
    ObjectSetText(name, DoubleToStr(price, Digits), 10, "Arial", label_color);
}

//+------------------------------------------------------------------+
//| عرض نطاق اليوم الحالي                                            |
//+------------------------------------------------------------------+
void DisplayTodayRange(int valid)
{
    double today_h = NormalizeDouble(iHigh(Symbol(), PERIOD_H1, iHighest(Symbol(), PERIOD_H1, MODE_HIGH, valid+1, 0)), Digits) / Point;
    double today_l = NormalizeDouble(iLow(Symbol(), PERIOD_H1, iLowest(Symbol(), PERIOD_H1, MODE_LOW, valid+1, 0)), Digits) / Point;

    CreateLabel("Today_Range_", xdis2+30, ydis2+100, DoubleToStr((today_h - today_l), 0),
               font_size2, font_type2, font_color2, corner);
}

//+------------------------------------------------------------------+
//| دالة تبسيط الأرقام (نفس الدالة الأصلية)                          |
//+------------------------------------------------------------------+
int trim(double h)
{
    double last;
    string no = DoubleToStr(h, 0);
    string nn[];
    int i;
    last = h;

    while(last > 9)
    {
        last = 0;
        for(i = 0; i < StringLen(no); i++)
        {
            nn[i] = StringSubstr(no, i, 1);
            last = StrToDouble(nn[i]) + last;
        }
        no = DoubleToStr(last, 0);
    }

    return(last);
}

//+------------------------------------------------------------------+
//| حذف جميع الكائنات                                                |
//+------------------------------------------------------------------+
int DeleteAllObjects()
{
    int i;
    string suffix;

    // حذف جميع الخطوط والكائنات لكل بار
    for(i = Bars; i >= 0; i--)
    {
        // تحديد اللاحقة حسب اليوم والساعة
        if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
            suffix = " ";
        else
            suffix = "";

        string date_string = TimeToStr(Time[i], TIME_DATE);

        // حذف مستويات HL العلوية (HL1-HL5)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete(HL_Upper_Names[j] + " " + date_string + suffix);
        }

        // حذف مستويات HL السفلية (HL10-HL14)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete(HL_Lower_Names[j] + " " + date_string + suffix);
        }

        // حذف مستويات LL العلوية (LL1-LL5)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete(LL_Upper_Names[j] + " " + date_string + suffix);
        }

        // حذف مستويات LL السفلية (LL10-LL14)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete(LL_Lower_Names[j] + " " + date_string + suffix);
        }

        // حذف المنطقة المغناطيسية
        ObjectDelete("Magnetic Area" + " " + date_string + suffix);
    }

    // حذف ليبلات المعلومات
    ObjectDelete("Range1");
    ObjectDelete("Range12");
    ObjectDelete("Range2");
    ObjectDelete("Range22");
    ObjectDelete("Range3");
    ObjectDelete("Range32");
    ObjectDelete("Range4");
    ObjectDelete("Range42");
    ObjectDelete("Range5");
    ObjectDelete("Range52");
    ObjectDelete("===");
    ObjectDelete("Pw_High");
    ObjectDelete("Pw_Low");
    ObjectDelete("Pw_Open");
    ObjectDelete("Pw_Highh");
    ObjectDelete("Pw_Loww");
    ObjectDelete("Pw_Openn");
    ObjectDelete("Today_Range");
    ObjectDelete("Today_Range_");
    ObjectDelete("Pre_day_Range_");
    ObjectDelete("Pre_day_Range");

    // حذف ليبلات الأسعار إذا كانت مفعلة
    if(show_price_Label == true)
    {
        // حذف ليبلات أسعار LL العلوية (LL1-LL5)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete("price_" + LL_Upper_Names[j]);
        }

        // حذف ليبلات أسعار LL السفلية (LL10-LL14)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete("price_" + LL_Lower_Names[j]);
        }

        // حذف ليبلات أسعار HL العلوية (HL1-HL5)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete("price_" + HL_Upper_Names[j]);
        }

        // حذف ليبلات أسعار HL السفلية (HL10-HL14)
        for(int j = 0; j < 5; j++)
        {
            ObjectDelete("price_" + HL_Lower_Names[j]);
        }
    }

    return(0);
}