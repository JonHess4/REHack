<?php

  const DB = "jhess";
  const PSWRD = "11827258";
  
 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML LANG="en">
  <HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <TITLE>SpielByWeb: Reef Encounter </TITLE>
    <LINK REL="stylesheet" HREF="pbw.css" TYPE="text/css">
  </HEAD>
  <BODY>
    <DIV CLASS=normal_text>
      <TABLE CELLPADDING=3 CELLSPACING=0 WIDTH="100%">
        <TR>
          <TD CLASS=menu>
            <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
              <TR VALIGN=BOTTOM>
                <TD COLSPAN=4>
                  <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
                    <TR VALIGN=BOTTOM>
                      <TD><SPAN CLASS=h2>SpielByWeb: Reef Encounter </SPAN></TD>
                      <TD ALIGN=RIGHT>Logged in as: <B>Jon Hess</B></TD>
                    </TR>
                  </TABLE>
                </TD>
              </TR>
              <TR VALIGN=TOP>
                <TD COLSPAN=4 BGCOLOR=0066CC HEIGHT=2></TD>
              </TR>
              <TR VALIGN=TOP>
                <TD COLSPAN=4><IMG SRC="images/tp.gif" WIDTH="800" HEIGHT="1" ALT=""></TD>
              </TR>
              <TR VALIGN=TOP ALIGN=CENTER>
                <TD CLASS=small_text_8 ALIGN=LEFT><A CLASS=menu HREF="index.php?sid=ec3c24e787a704f8c200de2a85db328f">Home</A> | <A CLASS=menuRed HREF="forum/faq.php?sid=ec3c24e787a704f8c200de2a85db328f">FAQ</A></TD>
                <TD CLASS=small_text_8><A CLASS=menu HREF="create.php?sid=ec3c24e787a704f8c200de2a85db328f">Create Game</A> | <A CLASS=menu HREF="games.php?sid=ec3c24e787a704f8c200de2a85db328f">Games List</A> | <A menu HREF=yourgames.php?sid=ec3c24e787a704f8c200de2a85db328f>Your Games</A> | <A CLASS=menu HREF="users.php?sid=ec3c24e787a704f8c200de2a85db328f">Stats</A></TD>
                <TD CLASS=small_text_8><A CLASS=menu HREF="forum/?sid=ec3c24e787a704f8c200de2a85db328f">Forum</A> (<A HREF="forum/search.php?search_id=newposts">202 new posts</A>) | <A CLASS=menu HREF="forum/viewforum.php?f=1&amp;sid=ec3c24e787a704f8c200de2a85db328f">Updates</A> | <a class=menuRed href="donate.php?sid=ec3c24e787a704f8c200de2a85db328f">Donate</a></TD>
                <TD ALIGN=RIGHT CLASS=small_text_8><A CLASS=menu HREF=forum/profile.php?mode=viewprofile&u=96091&amp;sid=ec3c24e787a704f8c200de2a85db328f>Profile</A> | <A CLASS=menu HREF=forum/profile.php?mode=editprofile&amp;sid=ec3c24e787a704f8c200de2a85db328f>Edit</A> | <A CLASS=menu HREF=vacation.php?sid=ec3c24e787a704f8c200de2a85db328f>Going Away?</A> | <A CLASS=menu HREF=login.php?logout=true&amp;sid=ec3c24e787a704f8c200de2a85db328f>Log out</A></TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
        <TR>
          <TD></TD>
        </TR>
        <TR>
          <TD CLASS=menu STYLE="border: solid red 1px; background-color: FFAAAA;" ALIGN=CENTER>SpeilByWeb costs $36 per month to host. If you enjoy playing games here, please consider <A HREF="/donate.php">donating</A> towards this expense. Thank you!</TD>
        </TR>
        <TR>
          <TD>
            <BR><SPAN CLASS=h3><A HREF=game.php?games_id=104820&amp;sid=ec3c24e787a704f8c200de2a85db328f>OakGame</A> Gamelog:</SPAN><BR>
            <IMG SRC=images/dot.gif HEIGHT=1 WIDTH=250><BR><BR>
            <TABLE CELLSPACING=0 CELLPADDING=2>
              <!--<TR>
                <TD COLSPAN=2><SPAN CLASS=small_text>Note: within each phase, log entries are listed in chronological order from top to bottom,<BR>but the phases are listed in reverse order (with the most recent listed first) to minimize scrolling.</SPAN><BR></TD>
              </TR>-->
<!-- here is where the log stuff starts-->
<br><br>testing <br>
<pre>
<?php
		$conn = mysql_connect("localhost", DB, PSWRD);
		
		$res = mysql_select_db(DB);
		$result = mysql_query("
			create table if not exists LogFile(
				tile action(125)
			);
		");
		$res = mysql_query("SELECT * from LogFile;");
				
		$r = mysql_num_rows($res);
		$c = mysql_num_fields($res);
		
		
		print("<table>");
		
		for ($i=0; $i<$r; $i++) {
			print"<tr>";
			$row = mysql_fetch_row($res);
			for ($j=0; $j<$c; $j++) {
				print "<td>" . $row[$j] . "</td>";
			}
			print "</tr>";
		}
		print("</table>");
		
		
		print "<br>";
		mysql_close($conn);
?>
</pre>
<br>testing
<br><br>

<!-- Final Round <tr> tag
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Final Round</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> triggered the end of the game by eating his/her last shrimp</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:03 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> had no shrimp-protected corals large enough to eat</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:03 pm)</span></td>
              </tr>
              
<!-- New Round <tr> tag
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 10</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 1, eating the shrimp at cell L4 and the 7-tile orange coral it was protecting, dropping 3 orange tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:03 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 9</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 1, eating the shrimp at cell E2 and the 6-tile gray coral it was protecting, dropping 2 gray tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:58 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 8, exchanging a orange larva cube for a orange polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:58 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a pink larva cube, along with 0 pink consumed polyp tiles and 3 pink polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space M4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space L5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space M5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 3, playing a orange larva cube, along with 3 orange consumed polyp tiles and 2 orange polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space L4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- An additional orange polyp tile was placed on the extra-growth space K4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space K3</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space M4, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space L5, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> interrupted action 2 to move a shrimp from cell C3 to cell L4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space M5, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 7, exchanging a pink consumed polyp tile for a red alga cylinder and playing it on coral tile 3</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a yellow larva cube and a white, a yellow, and a white polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 1, eating the shrimp at cell D5 and the 7-tile yellow coral it was protecting, dropping 3 yellow tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a orange larva cube, along with 0 orange consumed polyp tiles and 4 orange polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a orange polyp tile on space D5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- An additional orange polyp tile was placed on the extra-growth space D4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a orange polyp tile on space C5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a orange polyp tile on space E5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a orange polyp tile on space C4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 5, moving a shrimp from cell B5 to cell D5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a pink larva cube and a yellow, a yellow, and a yellow polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 7:03 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 8</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a gray larva cube, along with 0 gray consumed polyp tiles and 1 gray polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:49 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a gray polyp tile on space D1</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 7, exchanging a yellow consumed polyp tile for a red alga cylinder and playing it on coral tile 9</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a pink larva cube and a pink, a white, and a gray polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:51 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 1, eating the shrimp at cell L4 and the 5-tile gray coral it was protecting, dropping 1 gray tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:55 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a yellow larva cube, along with 0 yellow consumed polyp tiles and 1 yellow polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:55 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space B6</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:55 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 7, exchanging a pink consumed polyp tile for a blue alga cylinder and playing it on coral tile 1</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:56 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a white larva cube and a pink, a orange, and a yellow polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:57 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 7</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 1, eating the shrimp at cell J4 and the 7-tile pink coral it was protecting, dropping 3 pink tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:33 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a orange larva cube, along with 0 orange consumed polyp tiles and 3 orange polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space F2</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space E1</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a orange polyp tile on space F1</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 3, playing a gray larva cube, along with 0 gray consumed polyp tiles and 4 gray polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a gray polyp tile on space E2</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a gray polyp tile on space E1, attacking and consuming a orange polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a gray polyp tile on space F2, attacking and consuming a orange polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> interrupted action 2 to move a shrimp from cell D2 to cell E2</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a gray polyp tile on space F1, attacking and consuming a orange polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:34 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 7, exchanging a yellow consumed polyp tile for a green alga cylinder and playing it on coral tile 6</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:35 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a orange larva cube and a yellow, a orange, and a pink polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:35 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a gray larva cube, along with 0 gray consumed polyp tiles and 3 gray polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a gray polyp tile on space L4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- An additional gray polyp tile was placed on the extra-growth space K4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a gray polyp tile on space M4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a gray polyp tile on space L5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 5, moving a shrimp from cell L3 to cell L4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 7, exchanging a pink consumed polyp tile for a purple alga cylinder and playing it on coral tile 4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:43 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a yellow larva cube and a gray, a white, and a white polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:44 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 6</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 1, eating the shrimp at cell L4 and the 7-tile white coral it was protecting, dropping 3 white tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:20 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a pink larva cube, along with 0 pink consumed polyp tiles and 2 pink polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:21 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space J4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:21 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- An additional pink polyp tile was placed on the extra-growth space K4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:21 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space J6</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:21 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 5, moving a shrimp from cell I5 to cell J4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:21 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 7, exchanging a yellow consumed polyp tile for a blue alga cylinder and playing it on coral tile 10</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:22 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a gray larva cube and a white, a pink, and a orange polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:23 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a white larva cube, along with 0 white consumed polyp tiles and 2 white polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:28 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space B5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:28 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space A5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:29 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 5, moving a shrimp from cell K2 to cell B5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:29 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 3, playing a yellow larva cube, along with 0 yellow consumed polyp tiles and 2 yellow polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:29 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space C6</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:29 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space D6</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:29 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a gray larva cube and a yellow polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:30 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 5</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a yellow larva cube, along with 0 yellow consumed polyp tiles and 2 yellow polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:12 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a yellow polyp tile on space M5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:12 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a yellow polyp tile on space L6</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:12 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 6, exchanging a white consumed polyp tile for a white larva cube</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:12 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 3, playing a white larva cube, along with 0 white consumed polyp tiles and 3 white polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:13 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space M5, attacking and consuming a yellow polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:13 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space L6, attacking and consuming a yellow polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:13 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space M6</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:13 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a orange larva cube and a gray, a gray, and a gray polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:13 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a yellow larva cube and a orange, a gray, and a gray polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:17 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 4</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 4, introducing a shrimp on space D2</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:05 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a pink larva cube and a white, a orange, and a white polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:05 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 1, eating the shrimp at cell F4 and the 7-tile white coral it was protecting, dropping 3 white tiles into his/her parrotfish and returning 4 tiles to the supply</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:08 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 4, introducing a shrimp on space K2</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:10 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a white larva cube and a yellow, a pink, and a gray polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:10 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 3</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 4, introducing a shrimp on space C3</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:53 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a yellow larva cube and a pink, a gray, and a white polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:53 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 7, exchanging a orange consumed polyp tile for a purple alga cylinder and playing it on the alga cylinder space</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:59 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a pink larva cube, along with 0 pink consumed polyp tiles and 2 pink polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a pink polyp tile on space G3</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a pink polyp tile on space G5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 3, playing a white larva cube, along with 0 white consumed polyp tiles and 2 white polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space G3, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space G5, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:00 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 4, introducing a shrimp on space L3</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:02 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a orange larva cube and a yellow, a white, and a white polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 6:04 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 2</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a pink larva cube, along with 0 pink consumed polyp tiles and 3 pink polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:47 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space I5</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:48 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space I4, attacking and consuming a white polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:48 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a pink polyp tile on space I6</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:48 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 4, introducing a shrimp on space I5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:48 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a orange larva cube and a pink, a orange, and a gray polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:48 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a white larva cube, along with 0 white consumed polyp tiles and 4 white polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space F3</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space E4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space G4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a white polyp tile on space F5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 4, introducing a shrimp on space F4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:50 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a pink larva cube and a orange, a white, and a gray polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:51 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Round 1</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 2, playing a white larva cube, along with 0 white consumed polyp tiles and 3 white polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:39 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space L4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:39 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- An additional white polyp tile was placed on the extra-growth space K4</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:39 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space M4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:39 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> placed a white polyp tile on space L5, attacking and consuming a yellow polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:39 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 4, introducing a shrimp on space L4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:40 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> chose action 10, picking a gray larva cube and a yellow, a pink, and a pink polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:41 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 2, playing a yellow larva cube, along with 0 yellow consumed polyp tiles and 3 yellow polyp tiles from behind his/her screen</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:43 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space D5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:43 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- An additional yellow polyp tile was placed on the extra-growth space D4</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:43 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space C5, attacking and consuming a orange polyp tile</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:44 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3>  -- <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> placed a yellow polyp tile on space E5, attacking and consuming a pink polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:44 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 4, introducing a shrimp on space D5</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:45 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> chose action 10, picking a white larva cube and a orange, a white, and a white polyp tile</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:46 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Game Setup</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> Selected coral reef boards</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:24 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> Coral tiles start with the small brown algae down</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:24 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> Initial polyp tiles distributed on open sea board</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:24 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> picked a polyp tile to consume</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:25 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> picked two starting larva cubes</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:25 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> picked a polyp tile to consume</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> picked two starting larva cubes</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=F3F3F3> <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=94132" CLASS="player_ref_bold">Oakshard</A> had picked a white and a yellow larva cube</td>
                <td align=right bgcolor=F3F3F3 width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:38 pm)</span></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE> <A HREF="forum/profile.php?mode=viewprofile&u=992" CLASS="player_ref_bold">fendwick</A> had picked a pink and a white larva cube</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:38 pm)</span></td>
              </tr>
              <tr>
                <td colspan=2 valign=center align=center><br><IMG SRC=images/dot.gif HEIGHT=1 WIDTH=450><br><br><B>Game Start</B><BR><BR></td>
              </tr>
              <tr VALIGN=TOP>
                <td bgcolor=DDDDDD> The game has started!</td>
                <td align=right bgcolor=DDDDDD width=120><span class=small_text>&nbsp;&nbsp; (Sun Mar 01, 2015 5:24 pm)</span></td>
              </tr>
            </TABLE>
<!-- here is where the log ends, below is footer stuff -->
            <BR><BR>
            <B>Return to <A HREF=game.php?games_id=104820&amp;sid=ec3c24e787a704f8c200de2a85db328f>OakGame</A></B><BR>
            <BR>
          </TD>
        </TR>
        <TR>
          <TD CLASS=menu>
            <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH=100%>
              <TR VALIGN=TOP>
                <TD CLASS=small_text>Reef Encounter was designed by Richard Breese; published by <A HREF="http://www.whatsyourgame.it/">What's Your Game?</A> and <A HREF="http://www.zmangames.com/products/store_reef.htm">Z-Man Games</A>.<BR>Originally published by R&D Games with original artwork (used here at SpielByWeb) by Juliet Breese;.<br><br><B>If you enjoy playing Reef Encounter please support the designer and publisher by buying a copy of the game.</B><BR>It is available in USA from <A HREF="http://www.funagain.com/cgi-bin/funagain/015479?;;SBYW">Funagain Games</A>, and from other retailers around the world.<br><br>Play-by-Web coding by Mikael Sheikh based on code by <A HREF="http://www.amarriner.com/">Aaron Marriner</A>.</TD>
                <TD ALIGN=RIGHT>
                  <TABLE CELLSPACING=0 CELLPADDING=0>
                    <TR>
                      <TD ALIGN=RIGHT CLASS=small_text>Users Registered:</TD>
                      <TD WIDTH=3></TD>
                      <TD CLASS=small_text>9969</TD>
                    </TR>
                    <TR>
                      <TD ALIGN=RIGHT CLASS=small_text>Games Waiting:</TD>
                      <TD WIDTH=3></TD>
                      <TD CLASS=small_text>280</TD>
                    </TR>
                    <TR>
                      <TD ALIGN=RIGHT CLASS=small_text>Games in Progress:</TD>
                      <TD WIDTH=3></TD>
                      <TD CLASS=small_text>92</TD>
                    </TR>
                    <TR>
                      <TD ALIGN=RIGHT CLASS=small_text>Completed Games:</TD>
                      <TD WIDTH=3></TD>
                      <TD CLASS=small_text>98892</TD>
                    </TR>
                  </TABLE>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE>
    </DIV>
    <script type="text/javascript">
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
      var pageTracker = _gat._getTracker("UA-3991266-1");
      pageTracker._initData();
      pageTracker._trackPageview();
    </script>
  </BODY>
</HTML>

