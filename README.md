# 「再三推詞」以曲找詞歌詞推薦系統網頁
![ScreenShot](https://raw.github.com/fukuball/lyrics-match/master/p-asset/image/lyrics-match-screenshot.png)

## 動機與目標

華語流行音樂中，歌詞與歌曲都扮演重要的角色。台灣近代流行音樂的發展，校園民歌扮演重要的角色。而校園民歌的濫觴就是源自於楊弦以詩入歌，以余光中的詩作「鄉愁四韻」為詞而譜曲。後來，李雙澤高呼「唱自己的歌」後，開啟台灣校園民歌的熱潮。在這段時間，不少民歌的歌詞是採用知名作家的詩作，如三毛、余光中、席慕容 、蔣勳等人的作品。

目前也有很多華語流行音樂是翻唱自其他國家的歌曲，一般的作法都是保留原曲的主旋律，再填上中文的歌詞。例如《古老的大鐘》被歌手李聖傑翻唱，一般誤以為《古老的大鐘》源自於日本民謠，其實原作者是美國人 Henry Clay Work 於 1876 年作曲，在 1940 年代隨著戰爭的結束，傳入日本，經過翻譯成為了日本的民謠。因此，一首百年歌曲透過新的翻唱，填上新的歌詞，就可注入新的生命。

又如庾澄慶唱的「情非得已」與蘇永康唱的「幸福離我們很近」，都是由湯小康作曲的相同旋律，但歌詞卻不相同。又如鄧麗君唱的國語歌曲「誰來愛我」與李翊君唱的台語歌曲「苦海女神龍」也是相同的旋律，不同的歌詞。但是詞曲的搭配是門學問。影響歌詞的優劣的因素包括歌詞與歌曲的互相搭配、文字技巧、歌詞的情感深度等。

因此，本系統「再三推詞」是一個以曲找詞的舊曲新詞推薦系統，本系統提供使用者以輸入的歌曲，查詢適合搭配的歌詞。系統將根據詞曲搭配性，推薦適合搭配的歌詞，並以歌聲模擬軟體試唱。對華語流行音樂來說，提供舊曲新詞的音樂加值應用。對唱歌的愛好者來說， 可以有老歌新唱的趣味性。

-----------------------
## 系統功能

本系統提供使用者上傳音樂來取得適合搭配此首音樂的推薦歌詞清單。在推薦的歌詞結果中，系統會顯示歌曲音符與推薦歌詞的對應，因此使用者可以很容易的將推薦歌詞與上傳的歌曲配唱，同時，我們也將歌詞推薦結果用「虛擬歌手」配唱給使用者聆聽，讓使用者可以更深入的了解歌詞推薦結果在實際配唱起來的感覺。本系統提供的功能簡介如下：

### 1.歌曲結構分析

我們在寫作時，會將文章依據主題分段，每段又包含多個字句。當讀者在閱讀文章時，就可以依據段落來閱讀。相較於文章，音樂資料亦具有結構性。樂句就如同文章中的字句，多個樂句則堆疊成另一個結構「曲式」。曲式是指一首音樂的結構，對樂曲的整體面貌起著決定性的作用。

流行音樂歌曲的曲式與歌詞的詞式、歌曲的樂句與歌詞的字句之間，都具備搭配的對應關係。流行音樂的曲式，由主歌(Verse)、副歌(Chorus)、前奏、尾奏、間奏或過門所組成。常見的曲式諸如[前奏]→[主歌]→[副歌]→[間奏]→[主歌]→[副歌]→[尾奏]或[前奏]→[主歌]→[副歌]→[間奏]→[主歌]→[副歌]→[副歌]→[尾奏]等。曲式的每段又由多個樂句所組成。每個樂句則由多個連續的音符所組成。

由於本系統的輸入是Polyphonic MIDI 因此我們首先利用音程的關係，擷取出主旋律音軌。接著從主旋律中，利用Support Vector Machine學習樂句與歌詞的分段點的關係，進而找出樂句。接著利用音符數量、音程種類集合、音符種類集合三個特徵值來計算兩兩樂句之間的相似度，分別產生三個特徵對應的Self-Similarity Matrix(SSM)。接著分別對這三種特徵的SSM各自做Non-Negative Matrix Factorization產生新的特徵值，再利用此新的特徵值產生二階SSM。最後以此二階SSM找出曲式結構。


### 2.歌詞結構分析

歌詞也有歌詞的結構。系統首先將歌詞斷詞，接著根據字數結構、拼音結構、詞性結構、聲調音高四種特徵，利用詞行結構排比演算法建立歌詞倆倆詞行之間的Self-Similarity Matrix(SSM)。接著將四種特徵所形成的SSM做線性組合產生一個Hybrid SSM。接著在此Hybrid SSM上利用Dynamic Programming的方式進行重複樣式探勘(Repeating Pattern Mining)產生一個重複樣式的內聚力矩陣(cohesion matrix)。最後利用內聚力矩陣找出歌詞的詞式結構，並且利用人工整理好的規則來標記詞式段落(例如：主歌或副歌等等)。


### 3.詞曲結構對應

分析出歌曲結構與歌詞結構後，我們利用結構來做搭配的計算。首先，系統先將歌詞中的字數結構與歌曲的音符數結構做第一層次的最佳化對應(Alignment)。接下來系統根據歌詞聲韻與歌曲旋律的結構，以第二層Alignment演算法進行詞式與曲式的搭配，最後計算出詞曲的搭配分數，再根據搭配分數排名產生歌詞推薦清單。同時也產生歌詞中每個單字與歌曲中每個音符的對應關係，以供歌聲模擬軟體模擬試唱。

### 4.歌詞推薦

使用者要對一首歌曲配詞時，可以將音樂midi上傳到本系統，系統分析歌曲的音樂結構後，會比對現有的流行音樂歌詞，並分析計算與上傳音樂的結構符合的流行音樂歌詞，最後將比對結果最佳的數首歌詞推薦給使用者。

### 5.虛擬歌手試唱

系統針對使用者的查詢所回傳的結果，除了依照推薦分數排名的歌詞(或歌曲)之外，還提供虛擬歌手模擬人聲試唱，讓使用者試聽系統推薦的詞曲之效果。我們利用YAMAHA所開發的語音合成軟體VOCALOID。輸入旋律(MIDI)與歌詞，VOCALOID可以合成人聲的歌聲。其中，「初音未來」是目前非常熱門的虛擬歌手。本系統將推薦的歌詞與詞曲結構對應的結果，輸出成「初音未來」合成軟體支援的格式，將配唱結果由「初音未來」演唱，讓使用者可以聆聽各推薦歌詞實際配唱時帶來的感覺，將推薦結果用更直覺的方式呈現給使用者。

-----------------------
# 相關論文 
## 華語流行音樂之詞式分析與詞曲結構搭配之排比與同步
## 作者：范斯越
## 摘要

目前大部分的聽眾主要是透過歌詞與樂曲的搭配來了解音樂所要表達的內容，因此歌詞創作在目前的音樂工業是很重要的一環。一般流行音樂創作是由作曲人與作詞人共同完成，然而有另一種方式是將既有的詩詞做為歌詞，接著重新譜曲的方式產生新的流行音樂。這種創作方式是讓舊有的詞或曲注入新的生命力，得以流傳到現在。因此本研究希望可以為一首旋律推薦適合配唱的歌詞，以對數位音樂達到舊曲新詞的加值應用。本論文包括兩個部分，分別為：(1)自動分析歌詞的詞式，找出每個段落的位置與其段落的標籤；(2)詞曲結構搭配，找出相符合結構的詞與曲，並且同步每個漢字與音符。

本論文的第一部分為詞式分析，首先將歌詞擷取四個面向的特徵值，分別為(1)句字數結構；(2)拼音結構；(3)詞性；(4)聲調音高。第二步驟，利用這四種特徵值分別建立詞行的自相似度矩陣(Self Similarity Matrix)，並且利用這四個特徵的自相似度矩陣產生一個線性組合自相似度矩陣。第三步驟，建立在自相似度矩陣上我們做段落分群以及家族(Family)組合找出最佳的分段方式，最後將找出的分段方式利用我們整理出來的規則讓電腦自動標記段落標籤。第二部分為詞曲結構搭配，首先我們將主旋律的樂句以及歌詞的詞句做第一層粗略的對應，第二步驟，將對應好的樂句與詞句做第二層漢字與音符細部的對應，最後整合兩層對應的成本當做詞曲搭配的分數。

我們以KKBOX音樂網站當做歌詞來源，並且請專家標記華語流行歌詞資料庫的詞式。實驗顯示詞式分析的Pairwise f-score準確率達到0.83，標籤回復準確率達到0.78。詞曲結構搭配中，查詢的歌曲其原本搭配的歌詞，推薦排名皆為第一名。

## Abstract

Nowadays, lots of pop music audiences understand the content of music via lyrics and melody collocation. In general, a Chinese pop music is produced by composer and lyricist cooperatively. However, another producing manner is composing new melody with ancient poetry. Therefore, we want to recommend present lyrics for a melody and then achieving value-added application for digital music. This thesis includes two subjects. The first subject is lyrics form analysis. This subject is finding the block of verse, chorus, etc., in lyrics. The second subject is structure alignment between lyrics and melody. We utilize the result of lyrics form analysis and then employ a 2-tier alignment to recommend present lyrics which is suitable for singing.

In lyrics form analysis, the first step, we investigate four types of feature from lyrics: (1) Word Count Structure; (2) Pinyin Structure; (3) Part of Speech Structure; (4) Word Tone Pitch. For the second step, we utilize these four types of feature to construct a SSM(Self Similarity Matrix), and blend these four types of SSM to produce a linear combination SSM. The third step is clustering blocks and finding the best Family combination based on SSM. Finally, a rule-based technique is employed to label blocks of lyrics. For the second subject, the first step is aligning music phrases and lyrics sentences roughly. The second step is aligning a word and a note for corresponding phrase and sentence. Finally, we integrated the cost of two-level alignment regarded as the lyrics and melody collocation score.

We collect lyrics from KKBOX, a music web site, and invite experts label ground truth of lyrics form. The experimental result of lyrics form analysis shows that the proposed method achieves the Pairwise f-score of 0.83, and the Label Recovering Ratio of 0.78. The experiment of structure alignment between lyrics and melody shows that the original lyrics of query melodies are ranked number one.

## Reference

01. F. Bronson, The Billboard Book of Number One Hits, Billboard Books, 1997.
02. M. Cooper, and J. Foote, “Summarizing Popular Music via Structural Similarity Analysis,” Proc. of IEEE Workshop on Applications of Signal Processing to Audio and Acoustics, 2003.
03. J. Foote, “Visualizing Music and Audio Using Self-Similarity,” Proc. of ACM International Conference on Multimedia, 1999.
04. J. Foote, “Automatic Audio Segmentation Using a Measure of Audio Novelty,”. Proc. of IEEE International Conference on Multimedia and Expo, 2001.
05. H. Fujihara, M. Goto, J. Ogata, K. Komatani, T. Ogata, and H. G. Okuno, “Automatic Synchronization between Lyrics and Music CD Recordings Based on Viterbi Alignment of Segregated Vocal Signals,” Proc. of IEEE International Symposium on Multimedia, 2006.
06. S. Fukayama, K. Nakatsuma, S. S. Nagoya, Y. Yonebayashi, T. H. Kim, S. W. Qin, T. Nakano, T. Nishimoto, and S. Sagayama, “Orpheus: Automatic Composition System Considering Prosody of Japanese Lyrics,” Proc. of International Conference on Entertainment Computing, 2009.
07. S. Fukayama, K. Nakatsuma, S. Sako, T. Nishimoto, and S. Sagayama, “Automatic Song Composition from the Lyrics Exploiting Prosody of Japanese Language,” Proc. of Conference on Sound and Music Computing, 2010.
08. D. Iskandar, Y. Wang, M. Y. Kan, and H. Li, “Syllabic Level Automatic Synchronization of Music Signals and Text Lyrics,” Proc. of ACM International Conference on Multimedia, 2006.
09. M. Y. Kan, Y. Wang, D. Iskandar, T. L. Nwe, and A. Shenoy, ”LyricAlly: Automatic Synchronization of Textual Lyrics to Acoustic Music Signals,” IEEE Transactions on Audio, Speech and Language Processing, Vol. 16, No. 2, 2008.
10. T. Kitahara, S. Fukayama, S. Sagayama, H. Katayose, and N. Nagata, “An Interactive Music Composition System based on Autonomous Maintenance of Musical Consistency,” Proc. of Conference on Sound and Music Computing, 2011.
11. K. Lee, and M. Cremer, “Segmentation-based Lyrics-Audio Alignment Using Dynamic Programming,” Proc. of International Conference on Music Information Retrieval, 2008.
12. M. Levy, and M. Sandler, “Structural Segmentation of Musical Audio by Constrained Clustering,” IEEE Transactions on Audio, Speech, and Language Processing, Vol. 16, No. 2, 2008.
13. H. Lukashevich, “Towards Quantitative Measures of Evaluating Song Segmentation,” Proc. of International Society for Music Information Retrieval, 2008.
14. N. C. Maddage, and K. C. Sim, “Word Level Automatic Alignment of Music and Lyrics Using Vocal Synthesis,” ACM Transactions on Multimedia Computing, Communications and Applications, Vol. 6, No. 3, 2010.
15. M. Mauch, H. Fujihara, and M. Goto, “Lyrics-to-Audio Alignment and Phrase-level Segmentation Using Incomplete Internet-style Chord Annotations,” Proc. of Conference on Sound and Music Computing, 2010.
16. A. Mesaros, and T. Virtanen, “Automatic Alignment of Music Audio and Lyrics,” Proc. of International Conference on Digital Audio Effects, 2008.
17. M. Mueller, P. Grosche, and N. Jianq, “A Segment-Based Fitness Measure for Capturing Repetitive Structures of Music Recordings,” Proc. of International Society for Music Information Retrieval, 2011.
18. M. Mueller, and F. Kurth, “Towards Structural Analysis of Audio Recordings in the Presence of Musical Variations,” EURASIP Journal on Advances in Signal Processing, 2007.
19. M. Mueller, and F. Kurth, “Enhancing Similarity Matrices for Music Audio Analysis,” Acoustics, Speech and Signal Processing, 2006.
20. E. Nichols, D. Morris, S. Basu, and C. Raphael, “Relationships between Lyrics and Melody in Popular Music,” Proc. of International Society for Music Information Retrieval, 2009.
21. H. R. G. Oliveira, F. A. Cardoso, and F. C. Pereira, “Tra-la-Lyrics: An Approach to Generate Text Based on Rhythm,” Proc. of International Joint Workshop on Computational Creativity, 2007.
22. J. Paulus, and A. Klapuri, “Music Structure Analysis using a Probabilistic Fitness Measure and a Greedy Search Algorithm,” IEEE Transactions on Audio, Speech, and Language Processing, Vol. 17, No. 6, 2009.
23. J. Paulus, M. Muller, and A. Klapuri, “Audio-Based Music Structure Analysis,” Proc. of International Society for Music Information Retrieval, 2010.
24. G. Peeters, “Sequence Representation of Music Structure Using Higher-order Similarity Matrix and Maximum-likelihood Approach,” Proc. of International Society for Music Information Retrieval, 2007.
25. S. Qin, S. Fukayama, T. Nishimoto, and S. Sagayama, “Lexical Tones Learning with Automatic Music Composition System Considering Prosody of Mandarin Chinese,” Proc. of Second Language Studies: Acquisition, Learning, Education and Technology, 2010.
26. A. Ramakrishnan A, and S. L. Devi, “An Alternate Approach Towards Meaningful Lyric Generation in Tamil,” Proc. of NAACL HLT Second Workshop on Computational Approaches to Linguistic Creativity, 2010.
27. A. Ramakrishnan A, S. Kuppan, and S. L. Devi, “Automatic Generation of Tamil Lyrics for Melodies,” Proc. of Workshop on Computational Approaches to Linguistic Creativity, 2009.
28. H. Sakoe, and S. Chiba, “Dynamic Programming Algorithm Optimization for Spoken Word Recognition,” IEEE Transactions on Acoustics, Speech, and Signal Processing, Nr. 1, p. 43-49, 1987.
29. Y. Wang, M. Y. Kan, T. L. Nwe, A. Shenoy, and J. Yin, “LyricAlly:Automatic Synchronization of Acoustic Musical Signals and Textual Lyrics,” Proc. of ACM International Conference on Multimedia, 2004.
30. C. H. Wong, W. M. Szeto, and K. H. Wong, “Automatic Lyrics Alignment for Cantonese Popular Music,” Multimedia Systems, Vol. 12, No. 4-5, 2007.
31. S. Yu, J. Hong, and C. C. J. Kuo, “Similarity Matrix Processing for Music Structure Analysis,” Proc. of the 1st ACM Workshop on Audio and Music Computing Multimedia, 2006.
32. 楊蔭瀏、孫從音、陳幼韓、何為與李殿魁，語言與音樂，丹青圖書有限公司，1986。
33. 謝峰賜，簡易詞曲創作入門，新鳴遠出版有限公司，1993。
34. 陳建銘，國語流行歌曲中的編曲工作，國立台灣大學音樂研究所碩士論文，2002。
35. 徐富美與高林傳，歌詞聲調與旋律聲調相諧和的電腦檢測，世界華語文教學研討會論文集，2003。
36. 黃志華，粵語歌詞創作談，三聯出版社，2003。
37. 楊漢倫，粵語流行曲導論，香港特別行政區政府教育局，2009。
38. 張嘉惠、李淑瑩、林書彥、黃嘉毅與陳志銘，以最佳化及機率分佈判斷漢字聲符之研究，自然語言與語音處理研討會論文集(ROCLING)，2010。
39. 胡又天，流行詞話，第三期，2011。
40. 陳富容，現代華語流行歌詞格律初探，逢甲人文社會學報，第22期，第75-100頁，2011。
41. 樂句(Phrase)，http://en.wikipedia.org/wiki/Phrase_(music)
------------------------------------------------------------------
## 基植於非負矩陣分解之華語流行音樂曲式分析
## 作者：黃柏堯
## 摘要
近幾年來，華語流行音樂的發展越來越多元，而大眾所接收到的資訊是流行音樂當中的組成元素”曲與詞”，兩者分別具有賦予人類感知的功能，使人能夠深刻體會音樂作品當中所表答的內容與意境。然而，作曲與作詞都是屬於專業的創作藝術，作詞者通常在填詞時，會先對樂曲當中的結構進行粗略的分析，找出整首曲子的曲式，而針對可以填詞的部份，再進行更細部的分析將詞填入最適當的位置。流行音樂當中，曲與詞存在著密不可分的關係，瞭解歌曲結構不僅能降低填詞的門檻，亦能夠明白曲子的骨架與脈絡;在音樂教育與音樂檢索方面亦有幫助。
本研究的目標為，使用者輸入流行音樂歌曲，系統會自動分析出曲子的『曲式結構』。方法主要分成三個部分，分別為主旋律擷取、歌句分段與音樂曲式結構擷取。首先，我們利用Support Vector Machine以學習之方式建立模型後，擷取出符號音樂中之主旋律。第二步驟我們以”歌句”為單位，對主旋律進行分段，對於分段之結果建構出Self-Similarity Matrix矩陣。最後再利用Non-Negative Matrix Factorization針對不同特徵值矩陣進行分解並建立第二層之Self-Similarity Matrix矩陣，以歧異度之方式找出曲式邊界。
我們針對分段方式對歌曲結構之影響進行分析與觀察。實驗數據顯示，事先將歌曲以歌句單位分段之效果較未分段佳，而歌句分段之評測結果F-Score為0.82;將音樂中以不同特徵值建構之自相似度矩進行Non-Negative Matrix Factorization後，另一空間中之基底特徵更能有效地分辨出不同的歌曲結構，其F-Score為0.71。

## Abstract
Music structure analysis is helpful for music information retrieval, music education and alignment between lyrics and music. This thesis investigates the techniques of music structure analysis for Chinese popular music. 
Our work is to analyze music form automatically by three steps, main melody finding, sentence discovery, and music form discovery. First, we extract main melody based on learning from user-labeled sample using support vector machine. Then, the boundary of music sentence is detected by two-way classification using support vector machine. To discover the music form, the sentence-based Self-Similarity Matrix is constructed for each music feature. Non-negative Matrix Factorization is employed to extract the new features and to construct the second level Self-Similarity Matrix. The checkerboard kernel correlation is utilized to find music form boundaries on the second level Self-Similarity Matrix. 
Experiments on eighty Chinese popular music are performed for performance evaluation of the proposed approaches. For the main melody finding, our proposed learning-based approach is better than existing methods. The proposed approaches achieve 82% F-score for sentence discovery while 71% F-score for music form discovery.

## Referece
[1]    鄭淑儀, 台灣流行音樂與大眾文化, 私立輔仁大學大眾傳播所碩士論文, 1992。
[2]    文瀚, 流行音樂啟示錄, 萬象圖書, 1992。
[3]    吳祖強, 曲式與作品分析, 楊智文化, 1994。
[4]    曾慧佳, 從流行歌曲看台灣社會, 桂冠圖書, 1999。
[5]    陳建銘, 國語流行歌曲中的編曲工作, 國立台灣大學音樂研究所碩士論文, 2002。
[6]    黃志華, 粵語歌詞, 三聯書店, 2003。
[7]    何旻璟, Theme-Based Music Structure Analysis, 國立政治大學資訊科學所碩士論文, 2004。
[8]    徐大衛, 繆思的使徒-台灣戰後古典音樂樂評人的軌跡與信念, 國立台灣大學社會學研究所碩士論文, 2005。
[9]    楊漢倫, 粵語流行曲導論, 香港特別行政區教育局, 2009。
[10]    施啟智, 華語通俗音樂模組化數位音樂的構成、分析與應用, 樹德科技大學應用設計研究所碩士論文, 2009。
[11]    E. Cambouropoulos, “The Local Boundary Detection Model (LBDM) and its Application in the Study of Expressive Timing,” Proceedings of the International Computer Music Conference, ICMC, 2001.
[12]    C. C. Chang and C. J. Lin, “LIBSVM: A Library for Support Vector Machines,” Software Available at http://www.csie.ntu.edu.tw/~cjlin/libsvm
[13]    Y. J. Chen, A Fast Repeating Pattern Finding Algorithm for Music Data: A Human Perspective Approach, Master Thesis, Department of Computer Science, National Cheng Kung University, 2004.
[14]    J. Foote, “Visualizing Music and Audio Using Self-Similarity,” Proceedings of ACM International Conference on Multimedia, 1999.
[15]    J. Foote, “Automatic Audio Segmentation Using A Measure of Audio Novelty,” in Proceedings of IEEE International Conference on Multimedia and Expo, 1999.
[16]    C. Isikhan and G. Ozcan, ”A Survey of Melody Extraction Techniques for Music Information Retrieval,” Proceedings of the Conference on Interdisciplinary Musicology, CIM, 2008.
[17]    F. Kaiser and T. Sikora, “Music Structure Discovery in Popular Music Using Non-Negative Matrix Factorization,” Proceedings of International Society for Music Information Retrieval, ISMIR, 2010.
[18]    K. Lee and M. Slaney, ”Automatic Chord Recognition from Audio Using an HMM with Supervised Learning,” Proceedings of International Society for Music Information Retrieval, ISMIR, 2006.
[19]    F. Lerdahl, and R. Jackenoff, A Generative Theory of Tonal Music, MIT Press, 1983.
[20]    F. Lerdahl, Tonal Pitch Space, Oxford University Press, 2001.
[21]    D. D. Lee and H. S. Seung, “Algorithm for Non-negative Matrix, Factorization,” Advances in Neural Information Processing Systems, Vol. 13, 556–562, 2001.
[22]    S. E. Li, The Interaction between Melodies and Tones of the Lyrics in Mandarin Folk Songs, Master Thesis, Department of English, National Kaohsiung Normal University, 2002.
[23]    T. Li, M. Ogihara, and G. Tzanetakis, Music Data Mining, CRC Press, 2012.
[24]    Y. T. Lin, Cadences Detection for Music Structure Analysis, Master Thesis, Department of Computer Science, National Taiwan University, 2008.
[25]    N. C. Maddage, Content-based Music Structure Analysis, Ph.D. Thesis, Department of Computer Science, National Singapore University, 2005.
[26]    N. C. Maddage, H. Li, and M. S. Kankanhalli, “A Survey of Music Structure Analysis Techniques for Music Applications,” Multimedia Signal Processing and Communications, Vol. 231, 551-577, 2009.
[27]    C. McKay, Automatic Genre Classification of MIDI Recordings, Master Thesis, Department of Computer Science, McGill University, 2004.
[28]    C. McKay and I. Fujinaga, “jSymbolic: A Feature Extractor for MIDI Files,” Proceedings of the International Computer Music Conference, ICMC, 2006.
[29]    E. Nichols, “Relationships between Lyrics and Melody in Popular Music,” Proceedings of International Society for Music Information Retrieval, ISMIR, 2009.
[30]    J. Paulus, A. Klapuri, ”Music Structure Analysis By Finding Repeating Parts,” Proceedings of ACM International Conference on Multimedia, 2006.
[31]    J. Paulus, M. Muller, and A. Klapuri, “Audio-Based Music Structure Analysis,” Proceedings of International Society for Music Information Retrieval, ISMIR, 2010.
[32]    D. Rizo, P. J. P. Leon, A. Pertusa, and J. M. Inesta, ”Melodic Track Identification in MIDI Files,” Proceedings of the 19th International FLAIRS Conference, 2006.
[33]    T. Rocher, M. Robine, P. Hanna, and R. Strandh, “Dynamic Chord Analysis for Symbolic Music,” Proceedings of the International Computer Music Conference, ICMC, 2009.
[34]    X. Shao, N. C. Maddage, C. Xu, and M. S. Kankanhalli, “Automatic Music Summarization Based on Music Structure Analysis,” Proceedings of IEEE International Conference on Acoustics, Speech, and Signal Processing, ICASSP, 2005.
[35]    Y. Shiu, H. Jeong, and C. C. J. Kuo, “Similarity Matrix Processing for Music Structure Analysis,” Proceedings of 1st ACM Audio Music Computing Multimedia Workshop, 2006.
[36]    V. Y. F. Tan and C. F’evotte, “Automatic Relevance Determination in Nonnegative Matrix Factorization,” Proceedings of Signal Processing with Adaptive Sparse Structured Representations, SPARS, 2009.
[37]    M. Tang, Y. C. Lap, and B. Kao, “Selection of Melody Lines for Music Databases,” Proceedings of Annual International Computer Software and Application Conference, COMPSAC, 2000.
[38]    D. Temperley, The Cognition of Basic Musical Structures, MIT Press, 2001.
[39]    D. Temperley and D. Sleator, “The Melisma Music Analyzer,” Software Available at http://www.link.cs.cmu.edu/music-analysis/
[40]    S. Velusamy, B. Thoshkahna, and K. R. Ramakrishnan, “A Novel Melody Line Identification Algorithm for Polyphonic MIDI Music,” Lecture Notes in Computer Science, Advances in Multimedia Modeling, LNCS, p.p. 248-257, 2007.
[41]    P. H. Weng, An Automatic Musical Form Analysis System for Rondo and Fugue, Master Thesis, Department of Computer Science, National Tsing Hua University, 2004.
[42]    F. Wiering, J. D. Nooijer, A. Volk, and H. J. M. T. Schijf, ”Cognition-based Segmentation for Music Information Retrieval Systems,” Journal of New Music Research, Vol. 38, No. 2, 2009.
------
## License

All rights reserved.
